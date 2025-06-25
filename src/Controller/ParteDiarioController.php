<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\ParteDiario;
use App\Entity\User;
use App\Form\Campana1Type;
use App\Form\Campana2Type;
use App\Form\CombustibleType;
use App\Form\ContenedoresType;
use App\Form\EquipoRiegoType;
use App\Form\ExtraccionCombustibleType;
use App\Form\HechosExtraordinariosType;
use App\Form\MaquinaIngenieraType;
use App\Form\MortalidadType;
use App\Form\NacimientosType;
use App\Form\ParteDiarioType;
use App\Form\PecesType;
use App\Form\PiensoType;
use App\Form\ProduccionHuevosType;
use App\Form\TransportacionType;
use App\Repository\AsociacionSeccionRepository;
use App\Repository\ParteDiarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dom\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parte-diario')]
final class ParteDiarioController extends AbstractController
{
    #[Route(name: 'app_parte_diario_index', methods: ['GET'])]
    public function index(ParteDiarioRepository $parteDiarioRepository): Response
{
    return $this->render('parte_diario/index.html.twig', [
        'parte_diarios' => $parteDiarioRepository->findBy([], ['fecha' => 'DESC']),
    ]);
}

    #[Route(name: 'app_parte_diario_centro_new', methods: ['GET'])]
    public function centroIndex(): Response
    {
        return $this->render('parte_diario/centro_index.html.twig', [
            'centro_peces' => null,
        ]);
    }

    #[Route('/new', name: 'app_parte_diario_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
    
        // 1. Verificación de autenticación más robusta
        if (!$user || !$user->getEmpresa()) {
            $this->addFlash('error', 'Debes estar autenticado y asociado a una empresa');
            return $this->redirectToRoute('login');
        }
    
        // 2. Verificación de parte diario existente
        $existingParte = $this->isCreatedDay($entityManager, $user);
        if ($existingParte) {
            $this->addFlash('warning', 'Ya existe un parte diario para hoy');
            return $this->redirectToRoute('app_parte_diario_show', ['id' => $existingParte->getId()]);
        }
    
        // 3. Creación/obtención del parte diario
        $parteDiario = $this->getOrCreateParteDiario($entityManager, $user);
        $empresaNombre = $user->getEmpresa()->getName();
    
        // 4. Obtención del siguiente formulario con validación
        $nextForm = $this->getNextForm($parteDiario, $empresaNombre, 'create');
        
        // Manejo seguro del caso null o formulario incompleto
        if ($nextForm === null || !isset($nextForm['form_type'], $nextForm['entity'], $nextForm['name'])) {
            $parteDiario->setCompleto(true);
            $entityManager->flush();
            $this->addFlash('success', '¡Todos los formularios han sido completados!');
            return $this->redirectToRoute('app_parte_diario_index');
        }
    
        // 5. Creación del formulario con validación
        try {
            $form = $this->createForm($nextForm['form_type'], $nextForm['entity']);
        } catch (\InvalidArgumentException $e) {
            $this->addFlash('error', 'Error al crear el formulario: '.$e->getMessage());
            return $this->redirectToRoute('app_parte_diario_index');
        }
    
        $form->handleRequest($request);
    
        // 6. Procesamiento del formulario
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $setter = 'set' . $nextForm['property'];
                if (!method_exists($parteDiario, $setter)) {
                    throw new \BadMethodCallException("Método $setter no existe en ParteDiario");
                }
    
                $parteDiario->$setter($form->getData());
                $entityManager->flush();
    
                $this->addFlash('success', 'Datos guardados correctamente');
                return $this->redirectToRoute('app_parte_diario_new');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar: '.$e->getMessage());
            }
        }
    
        // 7. Renderizado de la vista
        return $this->render('parte_diario/new.html.twig', [
            'form' => $form->createView(),
            'form_name' => $nextForm['name'],
            'progress' => $this->calculateProgress($parteDiario),
            'empresa' => $empresaNombre,
            'current_step' => $nextForm['property'] // Para mostrar el progreso
        ]);
    }

    private function isCreatedDay(EntityManagerInterface $em, User $user)
    {
        $parteDiario = $em->getRepository(ParteDiario::class)
            ->findOneBy([
                'empresa' => $user->getEmpresa(),
                'fecha' => new \DateTime(), // Asume que es diario
                'completo' => true
            ], ['id' => 'DESC']); // Obtener el más reciente

        return $parteDiario;
    }
     
    private function getOrCreateParteDiario(EntityManagerInterface $em, $user): ParteDiario
    {
        // Buscar parte diario existente sin completar
        $parteDiario = $em->getRepository(ParteDiario::class)
            ->findOneBy([
                'empresa' => $user->getEmpresa(),
                'fecha' => new \DateTime(), //es diario
                'completo' => false
            ], ['id' => 'DESC']); // Obtener el más reciente
    
        // Crear nuevo si no existe
        if (!$parteDiario) {
            $parteDiario = new ParteDiario();
            $parteDiario->setFecha(new \DateTime());
            $parteDiario->setEmpresa($user->getEmpresa());
            $parteDiario->setCompleto(false);
            $em->persist($parteDiario);
            $em->flush();
        }
    
        return $parteDiario;
    }

/**
 * Obtiene el siguiente formulario a procesar, tanto para creación como edición.
 * 
 * @param ParteDiario $parteDiario
 * @param string $nombreEmpresa
 * @param string $mode 'create'|'edit' - Modo de operación
 * @return array|null
 */
private function getNextForm(ParteDiario $parteDiario, string $nombreEmpresa, string $mode): array
{
    // Validación del modo de operación
    if (!in_array($mode, ['create', 'edit'])) {
        throw new \InvalidArgumentException('Modo no válido. Use "create" o "edit"');
    }

    $forms = [
        'contenedores' => [
            'property' => 'Contenedores',
            'form_type' => ContenedoresType::class,
            'name' => 'Contenedores',
            'entity_class' => 'App\Entity\Contenedores'
        ],
        'campana1' => [
            'property' => 'Campana1',
            'form_type' => Campana1Type::class,
            'name' => 'Campaña 1',
            'entity_class' => 'App\Entity\Campana1'
        ],
        'campana2' => [
            'property' => 'Campana2',
            'form_type' => Campana2Type::class,
            'name' => 'Campaña 2',
            'entity_class' => 'App\Entity\Campana2'
        ],
        'combustible' => [
            'property' => 'Combustible',
            'form_type' => CombustibleType::class,
            'name' => 'Combustible',
            'entity_class' => 'App\Entity\Combustible'
        ],
        'equipoRiego' => [
            'property' => 'EquipoRiego',
            'form_type' => EquipoRiegoType::class,
            'name' => 'Equipo de Riego',
            'entity_class' => 'App\Entity\EquipoRiego'
        ],
        'extraccionCombustible' => [
            'property' => 'ExtraccionCombustible',
            'form_type' => ExtraccionCombustibleType::class,
            'name' => 'Extracción de Combustible',
            'entity_class' => 'App\Entity\ExtraccionCombustible'
        ],
        'hechosExtraordinarios' => [
            'property' => 'HechosExtraordinarios',
            'form_type' => HechosExtraordinariosType::class,
            'name' => 'Hechos Extraordinarios',
            'entity_class' => 'App\Entity\HechosExtraordinarios'
        ],
        'maquinaIngeniera' => [
            'property' => 'MaquinaIngeniera',
            'form_type' => MaquinaIngenieraType::class,
            'name' => 'Máquina Ingeniera',
            'entity_class' => 'App\Entity\MaquinaIngeniera'
        ],
        'mortalidad' => [
            'property' => 'Mortalidad',
            'form_type' => MortalidadType::class,
            'name' => 'Mortalidad',
            'entity_class' => 'App\Entity\Mortalidad'
        ],
        'nacimientos' => [
            'property' => 'Nacimientos',
            'form_type' => NacimientosType::class,
            'name' => 'Nacimientos',
            'entity_class' => 'App\Entity\Nacimientos'
        ],
        'peces' => [
            'property' => 'Peces',
            'form_type' => PecesType::class,
            'name' => 'Peces',
            'entity_class' => 'App\Entity\Peces'
        ],
        'pienso' => [
            'property' => 'Pienso',
            'form_type' => PiensoType::class,
            'name' => 'Pienso',
            'entity_class' => 'App\Entity\Pienso'
        ],
        'produccionHuevos' => [
            'property' => 'ProduccionHuevos',
            'form_type' => ProduccionHuevosType::class,
            'name' => 'Producción de Huevos',
            'entity_class' => 'App\Entity\ProduccionHuevos'
        ],
        'transportacion' => [
            'property' => 'Transportacion',
            'form_type' => TransportacionType::class,
            'name' => 'Transportación',
            'entity_class' => 'App\Entity\Transportacion'
        ],
    ];

    foreach ($forms as $config) {
        // Validación de configuración completa
        $requiredKeys = ['property', 'form_type', 'name', 'entity_class'];
        foreach ($requiredKeys as $key) {
            if (!isset($config[$key])) {
                throw new \RuntimeException("La configuración para {$config['property']} falta la clave: {$key}");
            }
        }

        $getter = 'get' . $config['property'];
        if (!method_exists($parteDiario, $getter)) {
            throw new \RuntimeException("El método {$getter} no existe en ParteDiario");
        }

        $entity = $parteDiario->$getter();

        // Creación: Busca primera entidad null
        if ($mode === 'create' && $entity === null) {
            $entity = new $config['entity_class']();
            
            // Inicialización condicional
            $setters = [
                'setNombreEntidad' => $nombreEmpresa,
                'setEmpresa' => $nombreEmpresa
            ];
            
            foreach ($setters as $setter => $value) {
                if (method_exists($entity, $setter)) {
                    $entity->$setter($value);
                }
            }

            return [
                'entity' => $entity,
                'form_type' => $config['form_type'],
                'name' => $config['name'],
                'property' => $config['property'],
                'mode' => $mode
            ];
        }

        // Edición: Busca primera entidad existente
        if ($mode === 'edit' && $entity !== null) {
            return [
                'entity' => $entity,
                'form_type' => $config['form_type'],
                'name' => $config['name'],
                'property' => $config['property'],
                'mode' => $mode
            ];
        }
    }

    // Retorno estructurado cuando no hay formularios
    return [
        'status' => 'completed',
        'message' => $mode === 'create' 
            ? 'Todos los formularios han sido completados' 
            : 'No hay más datos para editar',
        'entity' => null,
        'form_type' => null
    ];
}
    
    
    private function calculateProgress(ParteDiario $parteDiario): array
    {
        $totalForms = 14; // Número total de formularios
        
        $checkers = [
            'getContenedores',
            'getCampana1',
            'getCampana2',
            'getCombustible',
            'getEquipoRiego',
            'getExtraccionCombustible',
            'getHechosExtraordinarios',
            'getMaquinaIngeniera',
            'getMortalidad',
            'getNacimientos',
            'getPeces',
            'getPienso',
            'getProduccionHuevos',
            'getTransportacion',
        ];
        
        $completed = 0;
        foreach ($checkers as $getter) {
            if ($parteDiario->$getter() !== null) {
                $completed++;
            }
        }
        
        return [
            'completed' => $completed,
            'total' => $totalForms,
            'percent' => $totalForms > 0 ? round(($completed / $totalForms) * 100) : 0
        ];
    }

    #[Route('/{id}', name: 'app_parte_diario_show', methods: ['GET'])]
    public function show(ParteDiario $parteDiario): Response
    {
        $parteDiario->getNacimientos()->setTotalHoy($parteDiario->getNacimientos()->getVacunoHoy() + $parteDiario->getNacimientos()->getOvinohoy() + $parteDiario->getNacimientos()->getPorcinoHoy() + $parteDiario->getNacimientos()->getEquinoHoy());
        $parteDiario->getNacimientos()->setTotalAcumulado($parteDiario->getNacimientos()->getVacunoAcumulado() + $parteDiario->getNacimientos()->getOvinoAcumulado() + $parteDiario->getNacimientos()->getPorcinoAcumulado() + $parteDiario->getNacimientos()->getEquinoAcumulado());
        
        $parteDiario->getMortalidad()->setTotalA($parteDiario->getMortalidad()->getConejoHoy() + $parteDiario->getMortalidad()->getVacunoHoy() + $parteDiario->getMortalidad()->getOvinohoy() + $parteDiario->getMortalidad()->getPorcinoHoy() + $parteDiario->getMortalidad()->getEquinoHoy());
        $parteDiario->getMortalidad()->setTotalI($parteDiario->getMortalidad()->getConejoAcumulado() + $parteDiario->getMortalidad()->getVacunoAcumulado() + $parteDiario->getMortalidad()->getOvinoAcumulado() + $parteDiario->getMortalidad()->getPorcinoAcumulado() + $parteDiario->getMortalidad()->getEquinoAcumulado());
        
        $parteDiario->getEquipoRiego()->setTotalA($parteDiario->getEquipoRiego()->getEnrrolladorA() + $parteDiario->getEquipoRiego()->getMolinoVientoA() + $parteDiario->getEquipoRiego()->getRiegoElectricoA() + $parteDiario->getEquipoRiego()->getEquipoAbastoA());
        $parteDiario->getEquipoRiego()->setTotalI($parteDiario->getEquipoRiego()->getEnrrolladorI() + $parteDiario->getEquipoRiego()->getMolinoVientoI() + $parteDiario->getEquipoRiego()->getRiegoElectricoI() + $parteDiario->getEquipoRiego()->getEquipoAbastoI());
        
        $parteDiario->getMaquinaIngeniera()->setTotalA($parteDiario->getMaquinaIngeniera()->getBuldocerA() + $parteDiario->getMaquinaIngeniera()->getCargadorA() + $parteDiario->getMaquinaIngeniera()->getExcavadorA() + $parteDiario->getMaquinaIngeniera()->getAutoGruaA() + $parteDiario->getMaquinaIngeniera()->getGeA() + $parteDiario->getMaquinaIngeniera()->getMotoNiveladoraA());
        $parteDiario->getMaquinaIngeniera()->setTotalI($parteDiario->getMaquinaIngeniera()->getBuldocerI() + $parteDiario->getMaquinaIngeniera()->getCargadorI() + $parteDiario->getMaquinaIngeniera()->getExcavadorI() + $parteDiario->getMaquinaIngeniera()->getAutoGruaI() + $parteDiario->getMaquinaIngeniera()->getGeI() + $parteDiario->getMaquinaIngeniera()->getMotoNiveladoraI());

        $secciones = [
            'campana1' => [
                'titulo' => 'Campaña 1',
                'datos' => $parteDiario->getCampana1(),
                'campos' => ['roturadasPlan', 'roturadasReal', 'sembradasPlan', 'sembradasReal', 'roturadasPapaArrozPlan', 'roturadasPapaArrozReal', 'sembradasPapaArrozPlan', 'sembradasPapaArrozReal', 'otrasProducciones', 'otrasProduccionesReal']
            ,'label' => ['Hectareas Rotuladas(Plan)', 'Hectareas Rotuladas(Real)', 'Hectareas Sembradas(Plan)', 'Hectareas Sembradas(Real)', 'Hectareas Roturadas de Papa o Arroz (Plan)', 'Hectareas Roturadas de Papa o Arroz (Real)', 'Hectareas Sembradas de Papa o Arroz (Plan)', 'Hectareas Sembradas de Papa o Arroz (Real)', 'Otras Producciones(Plan)', 'Otras Producciones(Real)'] 

            ],
            'campana2' => [
                'titulo' => 'Campaña 2',
                'datos' => $parteDiario->getCampana2(),
                'campos' => ['recolectadasPlan', 'recolectadasReal', 'sembradasPlan', 'sembradasReal', 'roturadasPapaArrozPlan', 'roturadasPapaArrozReal', 'sembradasPapaArrozPlan', 'sembradasPapaArrozReal', 'otrasProduccionesPlan', 'otrasProduccionesReal']
            ,'label' => ['Hectareas Recolectadas(Plan)', 'Hectareas Recolectadas(Real)', 'Hectareas Sembradas(Plan)', 'Hectareas Sembradas(Real)', 'Hectareas Roturadas de Papa o Arroz (Plan)', 'Hectareas Roturadas de Papa o Arroz (Real)', 'Hectareas Sembradas de Papa o Arroz (Plan)', 'Hectareas Sembradas de Papa o Arroz (Real)', 'Otras Producciones(Plan)', 'Otras Producciones(Real)'] 
            ],
            'combustible' => [
                'titulo' => 'Combustible',
                'datos' => $parteDiario->getCombustible(),
                'campos' => ['dieselExistencia', 'dieselCobertura', 'gasolinaA83Existencia', 'gasolinaA83Cobertura', 'gasolinaA90Existencia', 'gasolinaA90Cobertura', 'lubricanteGrasaExistencia', 'lubricanteGrasaCobertura', 'lubricanteAceiteExistencia', 'lubricanteAceiteCobertura']
            ,'label' => ['Existencia de Diesel', 'Cobertura de Diesel', 'Existencia de Gasolina(A83)', 'Cobertura de Gasolina(A83)', 'Existencia de Gasolina(A90)', 'Cobertura de Gasolina(A90)', 'Existencia de Grasas', 'Cobertura de Grasas', 'Existencia de Aceites', 'Cobertura de Aceites']

            ],
            'equipoRiego' => [
                'titulo' => 'Equipo de Riego',
                'datos' => $parteDiario->getEquipoRiego(),
                'campos' => ['enrrolladorA', 'enrrolladorI', 'molinoVientoA', 'molinoVientoI', 'riegoElectricoA', 'riegoElectricoI', 'equipoAbastoA', 'equipoAbastoI', 'totalA', 'totalI']
                ,'label' => ['Enrollador(A)', 'Enrollador(I)', 'Molino a Viento(A)', 'Molino a Viento(I)', 'Riego Electrico(A)', 'Riego Electrico(I)', 'Equipo de Abasto(A)', 'Equipo de Abasto(I)', 'Total(A)', 'Total(I)']    
            ],
            'hechosExtraordinarios' => [
                'titulo' => 'Hechos Extraordinarios',
                'datos' => $parteDiario->getHechosExtraordinarios(),
                'campos' => ['acumuladosAnos', 'hsgMayorMenor', 'hgMayorMenor', 'hurtoRoboViolencia', 'hurtoRoboFuerza', 'hurtoRoboOtros', 'Arma', 'municion', 'accidenteTrabajo', 'accidenteTransito', 'muertos', 'heridos']
                ,'label' => ['Acumulados en el Años', 'HSG Mayor o Menor', 'HG Mayor o Menor', 'Hurto o Robo Violencia', 'Hurto o Robo Fuerza', 'Hurto o Robo(Otros)', 'Armas', 'Munición', 'Accidente de Trabajo', 'Accidente de Transito', 'Muertos', 'Heridos']
            ],
            'maquinaIngeniera' => [
                'titulo' => 'Máquina Ingeniera',
                'datos' => $parteDiario->getMaquinaIngeniera(),
                'campos' => ['buldocerA', 'buldocerI', 'cargadorA', 'cargadorI', 'excavadorA', 'excavadorI', 'autoGruaA', 'autoGruaI', 'geA', 'geI', 'motoNiveladoraA', 'motoNiveladoraI', 'totalA', 'totalI']
                ,'label' => ['Buldocer(A)', 'Buldocer(I)', 'Cargador(A)', 'Cargador(I)', 'Excavador(A)', 'Excavador(I)', 'Auto Grua(A)', 'Auto Grua(I)', 'GE(A)', 'GE(I)', 'Moto Niveladora(A)', 'Moto Niveladora(I)', 'Total(A)', 'Total(I)']
            ],
            'mortalidad' => [
                'titulo' => 'Mortalidad',
                'datos' => $parteDiario->getMortalidad(),
                'campos' => ['conejoHoy', 'conejoAcumulado', 'vacunoHoy', 'vacunoAcumulado', 'ovinohoy', 'ovinoAcumulado', 'porcinoHoy', 'porcinoAcumulado', 'equinoHoy', 'equinoAcumulado', 'totalA', 'totalI']
                ,'label' => ['Conejo(Hoy)', 'Conejo(Acumulado)', 'Vacuno(Hoy)', 'Vacuno(Acumulado)', 'Ovino(Hoy)', 'Ovino(Acumulado)', 'Porcino(Hoy)', 'Porcino(Acumulado)', 'Equino(Hoy)', 'Equino(Acumulado)', 'Total(A)', 'Total(I)']
            ],
            'nacimientos' => [
                'titulo' => 'Nacimientos',
                'datos' => $parteDiario->getNacimientos(),
                'campos' => ['vacunoHoy', 'vacunoAcumulado', 'ovinohoy', 'ovinoAcumulado', 'porcinoHoy', 'porcinoAcumulado', 'equinoHoy', 'equinoAcumulado', 'totalHoy', 'totalAcumulado']
                ,'label' => ['Vacuno(Hoy)', 'Vacuno(Acumulado)', 'Ovino(Hoy)', 'Ovino(Acumulado)', 'Porcino(Hoy)', 'Porcino(Acumulado)', 'Equino(Hoy)', 'Equino(Acumulado)', 'Total(Hoy)', 'Total(Acumulado)']
            ],
            'peces' => [
                'titulo' => 'Peces',
                'datos' => $parteDiario->getPeces(),
                'campos' => ['plan', 'existanciaDiariaReal', 'existenciaacumuladaReal']
                ,'label' => ['Plan', 'Existencia Diaria Real', 'Existencia Acumulada Real']
            ],
            'pienso' => [
                'titulo' => 'Pienso',
                'datos' => $parteDiario->getPienso(),
                'campos' => ['avicolaPlan', 'avicolaReal', 'avicolaCovertura', 'porcinoPlan', 'porcinoReal', 'porcinoCovertura', 'piensoLiquidoPlan', 'piensoLiquidoAcumuladoDia', 'piensoLiquidoReal', 'extraccionMateriaPrimaDia', 'extraccionMateriaPrimaAcumulada']
                ,'label' => ['Avicola(Plan)', 'Avicola(Real)', 'Avicola Covertura', 'Porcino(Plan)', 'Porcino(Real)', 'Porcino Covertura', 'Pienso Liquido(Plan)', 'Pienso Liquido(Acumulado Dia)', 'Pienso Liquido(Real)', 'Extraccion de Materia Prima(Dia)', 'Extraccion de Materia Prima(Acumulada)']
            ],
            'produccionHuevos' => [
                'titulo' => 'Producción de Huevos',
                'datos' => $parteDiario->getProduccionHuevos(),
                'campos' => ['plan', 'existenciaDiaria', 'existenciaAcumulada', 'existenciaAlmacen']
                ,'label' => ['Plan', 'Existencia Diaria', 'Existencia Acumulada', 'Existencia en Almacen']
            ],
            'contenedores' => [
                'titulo' => 'Contenedores',
                'datos' => $parteDiario->getContenedores(),
                'campos' => ['observaciones', 'puerto', 'cantidad', 'cantidadExtraida', 'tipoMercancia']
            ,'label' => ['Observaciones', 'Puerto', 'Cantidad', 'Cantidad Extraida', 'Tipo Mercancia']
            ],
            'transportacion' => [
                'titulo' => 'Transportación',
                'datos' => $parteDiario->getTransportacion(),
                'campos' => ['tipoTransporte', 'destinoCarga', 'cantidad', 'tipoMercancia']
                ,'label' => ['Tipo de Transporte', 'Destino de Carga', 'Cantidad', 'Tipo de Mercancia']
            ],
            'extraccionCombustible' => [
                'titulo' => 'Extracción de Combustible',
                'datos' => $parteDiario->getExtraccionCombustible(),
                'campos' => ['tipoCombustible', 'lugarExtraccion', 'cantidad', 'destino']
                ,'label' => ['Tipo de Combustible', 'Lugar de Extracción', 'Cantidad Extraida', 'Destino']
            ],
        ];
        return $this->render('parte_diario/show.html.twig', [
            'parte_diario' => $parteDiario,
            'secciones' => $secciones,
        'fecha' => $parteDiario->getFecha(),
        'empresa' => $parteDiario->getEmpresa()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parte_diario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParteDiario $parteDiario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParteDiarioType::class, $parteDiario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parte_diario_index', [], Response::HTTP_SEE_OTHER);
        }

        $user = $this->getUser();

        if (!$user || !$user->getEmpresa()) {
            return $this->redirectToRoute('login');
        }
    
        $empresa = $user->getEmpresa()->getName();

        $nextForm = $this->getNextForm($parteDiario, $empresa, 'edit');

        return $this->render('parte_diario/edit.html.twig', [
            'parte_diario' => $parteDiario,
            'form' => $form,
            'empresa' => $empresa,
            'form_name' => $nextForm['name'],
            'progress' => $this->calculateProgress($parteDiario),
        ]);
    }

    #[Route('/{id}', name: 'app_parte_diario_delete', methods: ['POST'])]
    public function delete(
        Request $request, 
        ParteDiario $parteDiario, 
        EntityManagerInterface $entityManager
    ): Response {
        // 1. Verificar que el usuario pertenezca a la misma empresa
        $usuario = $this->getUser();
        
        if (!$usuario || $usuario->getEmpresa() !== $parteDiario->getEmpresa()) {
            $this->addFlash('error', 'No tienes permisos para eliminar este parte diario.');
            return $this->redirectToRoute('app_parte_diario_index');
        }
    
        // 2. Validar CSRF token
        if ($this->isCsrfTokenValid('delete'.$parteDiario->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parteDiario);
            $entityManager->flush();
            $this->addFlash('success', 'Parte diario eliminado correctamente.');
        }
    
        return $this->redirectToRoute('app_parte_diario_index');
    }

    #[Route('/new/og', name: 'app_parte_diario_new_og', methods: ['GET', 'POST'])]
    public function newOg(): Response
    {
        return $this->render('parte_diario/new_og.html.twig', [
            'form' => $this->createForm(ParteDiarioType::class),
        ]);
    }
}
