# DWES - Proyecto Final

> Alonso Hernández Robles 2º DAW AULA

## CRUD - Tabla de Progreso

| Clase | Create | Read | Update | Delete |
|-------|--------|------|--------|--------|
| Categoria | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: |
| Producto | :heavy_check_mark: | :x: | :heavy_check_mark: | :heavy_check_mark: |
| Pedido | :x: | :x: | :x: | :x: |
| Usuario | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: |

## CRUD - Tabla de Funcionalidades

- **Crear**: Objetos ilimitadamente.
- **Leer**: Todos los objetos de la clase.
- **Actualizar**: Todos los objetos de la clase.
- **Borrar**: Todos los objetos de la clase.

| Clase | Create | Read | Update | Delete |
|-------|--------|------|--------|--------|
| Categoria | `admin` | `admin` + `user` | `admin` | `admin` |
| Producto | `admin` | `admin` + `user` | `admin` | `admin` |
| Pedido | `admin` + `user` | `admin` | `admin` | `admin` |
| Usuario | `admin` + `user` | `admin` | `admin` + `user` | `admin` + `user` |