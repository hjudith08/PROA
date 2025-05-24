-- Asociar todas las asignaturas del grupo '001' a estos alumnos
INSERT INTO alumnos_asignaturas (dni_alumno, id_asignatura)
SELECT u.dni, a.id_asignatura
FROM usuarios u
         JOIN asignaturas a ON a.grupo_id = '001'
WHERE u.dni IN ('9218611', '1320191', '9971924') AND u.rol_id = 'alumno';

