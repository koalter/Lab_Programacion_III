select * from alumno as a, localidad as l
where a.Idlocalidad = l.Id;

select a.apellido, l.Nombre, m.Descripcion, ma.Cuatrimestre, ma.Nota from alumno a, materia m, materia_alumno ma, localidad l
where a.IdLocalidad = l.Id
and a.Id = ma.IdAlumno
and m.Id = ma.IdMateria;

select * from alumno a, localidad l
where l.Id = a.IdLocalidad
and l.Nombre = 'La Plata';

select count(a.Apellido) as Cantidad from alumno a, localidad l
where l.Id = a.IdLocalidad
and l.Nombre = 'La Plata';

select sum(nota) from materia_alumno;
