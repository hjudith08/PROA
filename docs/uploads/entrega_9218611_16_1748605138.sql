INSERT INTO tareas (id_asignatura, titulo, descripcion, fecha_apertura, fecha_entrega, puntuacion_maxima, archivo_adjunto, creado_por, grupo_id)
SELECT
    t.id_asignatura,
    t.titulo,
    t.descripcion,
    t.fecha_apertura,
    t.fecha_entrega,
    10.00,
    NULL,
    pa.dni_profesor,
    '001'
FROM (
         -- Aquí pongo las tareas para cada asignatura con id_asignatura y sus 3 tareas
         SELECT 101 AS id_asignatura, 'Práctica 1. Asíncronía y Filtros' AS titulo, 'Explora programación asíncrona y diseño de filtros en C++.' AS descripcion, '2025-01-01' AS fecha_apertura, '2025-01-15' AS fecha_entrega
         UNION ALL
         SELECT 101, 'Práctica 2. Concurrencia y Hilos', 'Gestiona múltiples hilos y sincronización de datos en C++.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 101, 'Práctica 3. STL y Algoritmos', 'Utiliza la Standard Template Library para resolver problemas comunes.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 102, 'Práctica 1. Circuitos Básicos', 'Diseña y analiza circuitos eléctricos básicos y componentes electrónicos.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 102, 'Práctica 2. Electrónica Digital', 'Implementa circuitos digitales usando compuertas y flip-flops.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 102, 'Práctica 3. Análisis de Señales', 'Estudia y procesa señales eléctricas con herramientas electrónicas.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 103, 'Práctica 1. Leyes de Newton', 'Aplica las leyes de Newton en problemas físicos fundamentales.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 103, 'Práctica 2. Dinámica y Cinemática', 'Analiza movimiento de partículas y sistemas de cuerpos.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 103, 'Práctica 3. Termodinámica Básica', 'Estudia la energía, trabajo y calor en sistemas físicos.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 104, 'Práctica 1. Matrices y Operaciones', 'Realiza operaciones básicas con matrices y vectores.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 104, 'Práctica 2. Sistemas de Ecuaciones Lineales', 'Resuelve sistemas usando métodos matriciales.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 104, 'Práctica 3. Aplicaciones del Álgebra Lineal', 'Aplica álgebra matricial en problemas reales.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 105, 'Práctica 1. Planificación de Proyectos', 'Organiza las fases del proyecto CDIO.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 105, 'Práctica 2. Desarrollo de Prototipos', 'Construye prototipos funcionales para el proyecto.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 105, 'Práctica 3. Presentación y Evaluación', 'Prepara presentaciones para evaluar el proyecto.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 106, 'Práctica 1. Diseño Técnico Básico', 'Realiza dibujos técnicos y bocetos de diseño.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 106, 'Práctica 2. Herramientas de CAD', 'Usa software CAD para diseño asistido.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 106, 'Práctica 3. Documentación Técnica', 'Elabora documentación para diseños técnicos.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 107, 'Práctica 1. Fundamentos de Redes', 'Estudia modelos OSI y TCP/IP.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 107, 'Práctica 2. Configuración de Equipos', 'Configura routers y switches básicos.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 107, 'Práctica 3. Seguridad en Redes', 'Aplica conceptos básicos de seguridad de red.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 108, 'Práctica 1. Principios de Diseño UI', 'Analiza principios básicos de diseño de interfaces.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 108, 'Práctica 2. Prototipado de Interfaces', 'Crea prototipos funcionales con herramientas UI.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 108, 'Práctica 3. Evaluación de Usabilidad', 'Realiza tests de usabilidad y mejora interfaces.', '2025-03-01', '2025-03-15'

         UNION ALL
         SELECT 109, 'Práctica 1. Programación Orientada a Objetos', 'Desarrolla conceptos avanzados de POO en C++.', '2025-01-01', '2025-01-15'
         UNION ALL
         SELECT 109, 'Práctica 2. Plantillas y Excepciones', 'Implementa plantillas y manejo de excepciones.', '2025-02-01', '2025-02-15'
         UNION ALL
         SELECT 109, 'Práctica 3. Optimización de Código', 'Aplica técnicas para optimizar el rendimiento.', '2025-03-01', '2025-03-15'
     ) t
         JOIN profesores_asignaturas pa ON pa.id_asignatura = t.id_asignatura;
