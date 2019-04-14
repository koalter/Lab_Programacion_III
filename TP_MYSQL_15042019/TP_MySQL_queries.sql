use utn;

-- 1. Obtener los detalles completos de todos los productos, ordenados alfabéticamente.
select * from productos p
order by p.pNombre;

-- 2. Obtener los detalles completos de todos los proveedores de ‘Quilmes’.
select * from provedores p
where p.localidad = 'Quilmes';

-- 3. Obtener todos los envíos en los cuales la cantidad este entre 200 y 300 inclusive.
select * from envios e
where e.cantidad between 200 and 300;

-- 4. Obtener la cantidad total de todos los productos enviados.
select sum(cantidad) as 'cantidad total' from envios e;

-- 5. Mostrar los primeros 3 números de productos que se han enviado.
select top 3 pNumero from envios

-- 6. Mostrar los nombres de proveedores y los nombres de los productos enviados.
select prov.nombre, prod.pNombre from provedores prov, productos prod, envios e
where prov.numero = e.numero and prod.pNumero = e.pNumero;

-- 7. Indicar el monto (cantidad * precio) de todos los envíos.
select prov.*, prod.*, e.cantidad, (cantidad * precio) as 'monto' from provedores prov, productos prod, envios e
where prov.numero = e.numero and prod.pNumero = e.pNumero;

-- 8. Obtener la cantidad total del producto 1 enviado por el proveedor 102.
select sum(cantidad) 'cantidad total' from envios e
where e.pNumero = 1 and e.numero = 102

-- 9. Obtener todos los números de los productos suministrados por algún proveedor de ‘Avellaneda’.
select prod.pNumero from provedores prov, productos prod, envios e
where prod.pNumero = e.pNumero and prov.numero = e.numero
and prov.localidad = 'avellaneda'

-- 10. Obtener los domicilios y localidades de los proveedores cuyos nombres contengan la letra ‘I’.
select provedores.domicilio, provedores.localidad from provedores
where nombre like '%i%'

-- 11. Agregar el producto numero 4, llamado ‘Chocolate’, de tamaño chico y con un precio de 25,35.
IF NOT EXISTS (select * from productos where pNumero = 4 or pNombre = 'Chocolate')
insert into productos (pNumero, pNombre, precio, tamaño)
values (4, 'Chocolate', 25.35, 'Chico');

-- 12. Insertar un nuevo proveedor (únicamente con los campos obligatorios).
IF NOT EXISTS (select * from provedores where numero = 103)
insert into provedores (numero) values (103);

-- 13. Insertar un nuevo proveedor (107), donde el nombre y la localidad son ‘Rosales’ y ‘La Plata’.
IF NOT EXISTS (select * from provedores where numero = 107 or nombre = 'Rosales' or localidad = 'La Plata')
insert into provedores (numero, nombre, localidad)
values (107, 'Rosales', 'La Plata')

-- 14. Cambiar los precios de los productos de tamaño ‘grande’ a 97,50.
select * from productos where tamaño = 'grande'; --BEFORE
update productos set precio = 97.50
where tamaño = 'grande';
select * from productos where tamaño = 'grande'; --AFTER

-- 15. Cambiar el tamaño de ‘Chico’ a ‘Mediano’ de todos los productos cuyas cantidades sean mayores a 300 inclusive.
select * from productos prod, envios e where prod.pNumero = e.pNumero and e.cantidad >= 300; --BEFORE
update productos set tamaño = 'Mediano' 
where tamaño = 'Chico' 
and pNumero in (select distinct prod.pNumero from productos prod, envios e where prod.pNumero = e.pNumero and e.cantidad >= 300 and prod.tamaño = 'Chico');
select * from productos prod, envios e where prod.pNumero = e.pNumero and e.cantidad >= 300; --AFTER

-- 16. Eliminar el producto número 1.
delete from productos where pNumero = 1;

-- 17. Eliminar a todos los proveedores que no han enviado productos.
delete from provedores 
where numero not in 
(select distinct prov.numero from provedores prov, productos prod, envios e
where prov.numero = e.numero and prod.pNumero = e.pNumero);