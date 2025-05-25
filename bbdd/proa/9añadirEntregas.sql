INSERT INTO entregas (id_tarea, dni_alumno, archivo_entregado, fecha_entrega, nota, comentarios_profesor, grupo_id)
VALUES
    -- Alumno 9218611 entrega la tarea 1
    (1, '9218611', 'practica1_9218611.zip', '2025-01-10 15:00:00', 9.5, 'Muy buen trabajo.', '001'),

    -- Alumno 1320191 entrega la tarea 1 en otra fecha
    (1, '1320191', 'practica1_1320191.zip', '2025-01-11 11:30:00', 7.0, 'Bien, pero faltan detalles.', '001'),

    -- Alumno 9971924 entrega tarea 2
    (2, '9971924', 'practica2_9971924.zip', '2025-02-12 16:30:00', 8.0, NULL, '001'),

    -- Alumno 1100111 entrega tarea 3
    (3, '1100111', 'practica3_1100111.zip', '2025-03-14 14:45:00', 7.5, 'Falta mejorar la optimización.', '001'),

    -- Alumno 1100112 entrega tarea 2 en otra fecha
    (2, '1100112', 'practica2_1100112.zip', '2025-02-13 10:15:00', 6.5, 'Correcto, pero incompleto.', '001'),

    -- Alumno 1100113 entrega tarea 3
    (3, '1100113', 'practica3_1100113.zip', '2025-03-15 10:00:00', 10.0, 'Excelente trabajo.', '001');
