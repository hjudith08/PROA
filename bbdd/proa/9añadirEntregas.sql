INSERT INTO entregas (id_tarea, dni_alumno, archivo_entregado, fecha_entrega, nota, comentarios_profesor, grupo_id)
VALUES
    -- Alumno 9218611 entrega la tarea 1 con archivo y nota
    (1, '9218611', 'practica1_9218611.zip', '2025-01-10 15:00:00', 9.5, 'Muy buen trabajo.', '001'),

    -- Alumno 1320191 no entrega la tarea 1 (fecha_entrega NULL)
    (1, '1320191', NULL, NULL, NULL, NULL, '001'),

    -- Alumno 9971924 entrega tarea 2 sin comentarios aún
    (2, '9971924', 'practica2_9971924.zip', '2025-02-12 16:30:00', 8.0, NULL, '001'),

    -- Alumno 1100111 entrega tarea 3 con nota y comentarios
    (3, '1100111', 'practica3_1100111.zip', '2025-03-14 14:45:00', 7.5, 'Falta mejorar la optimización.', '001'),

    -- Alumno 1100112 no entrega tarea 2
    (2, '1100112', NULL, NULL, NULL, NULL, '001'),

    -- Alumno 1100113 entrega tarea 3 con nota
    (3, '1100113', 'practica3_1100113.zip', '2025-03-15 10:00:00', 10.0, 'Excelente trabajo.', '001');
