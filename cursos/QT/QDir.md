---
layout: cabeza3
---

# Clase QDir
La clase QDir en Qt proporciona métodos para acceder y manipular directorios y su contenido, como archivos y subdirectorios. Esta clase facilita el manejo de rutas de archivos y directorios de manera multiplataforma, y permite realizar operaciones como listar archivos, crear o eliminar directorios, y navegar en el sistema de archivos.
***
## Características Principales de QDir
- Manipulación de directorios: Crear, eliminar, y navegar entre directorios.
- Filtrado y ordenación: Filtrar archivos y directorios según ciertos criterios (nombre, tipo, fecha, etc.) y ordenarlos.
- Operaciones en archivos: Copiar, mover, y eliminar archivos dentro de directorios.
***
## Métodos Principales de QDir
1. ### QDir()
    Constructor que crea un objeto QDir que apunta al directorio actual del sistema.

    Ejemplo:
    ```cpp
    QDir dir;  // Crea un QDir en el directorio actual
    ```
2. ### QDir(const QString &path)
    Constructor que crea un objeto QDir apuntando a la ruta especificada por path.

    Ejemplo:
    ```cpp
    QDir dir("/home/usuario/Documentos");
    ```
3. ### bool exists() const
    Verifica si el directorio representado por QDir existe.
    - Retorno: true si el directorio existe, false de lo contrario.

    Ejemplo:
    ```cpp
    if (dir.exists()) {
        // El directorio existe
    }
    ```
4. ### bool mkdir(const QString &dirName) const
    Crea un nuevo subdirectorio en el directorio actual.
    - Retorno: true si el directorio fue creado exitosamente, false de lo contrario.

    Ejemplo:
    ```cpp
    if (dir.mkdir("nuevo_directorio")) {
        // El directorio fue creado exitosamente
    }
    ```
5. ### bool rmdir(const QString &dirName) const
    Elimina un subdirectorio vacío dentro del directorio actual.
    - Retorno: true si el subdirectorio fue eliminado, false de lo contrario.

    Ejemplo:
    ```cpp
    if (dir.rmdir("directorio_vacio")) {
        // El subdirectorio fue eliminado
    }
    ```
6. ### QStringList entryList(QDir::Filters filters = QDir::NoFilter, QDir::SortFlags sort = QDir::NoSort) const
    Devuelve una lista de archivos y directorios en el directorio actual, filtrada y ordenada según los parámetros especificados.
    Parámetros:
    - filters: Opciones para filtrar los elementos (por ejemplo, solo archivos o solo directorios).
    - sort: Opciones para ordenar los elementos (por nombre, fecha, tamaño, etc.).

    Ejemplo:
    ```cpp
    QStringList archivos = dir.entryList(QDir::Files, QDir::Name);
    for (const QString &archivo : archivos) {
        qDebug() << archivo;
    }
    ```
7. ### bool remove(const QString &fileName) const
    Elimina un archivo en el directorio actual.
    - Retorno: true si el archivo fue eliminado con éxito, false de lo contrario.

    Ejemplo:
    ```cpp
    if (dir.remove("archivo.txt")) {
        // El archivo fue eliminado
    }
    ```
8. ### bool rename(const QString &oldName, const QString &newName) const
    Renombra o mueve un archivo o directorio dentro del directorio actual.
    - Retorno: true si la operación fue exitosa, false de lo contrario.

    Ejemplo:
    ```cpp
    if (dir.rename("archivo_viejo.txt", "archivo_nuevo.txt")) {
        // El archivo fue renombrado
    }
    ```
9. ### bool cd(const QString &dirName)
    Cambia el directorio actual al subdirectorio especificado.
    - Retorno: true si el cambio fue exitoso, false de lo contrario.

    Ejemplo:
    ```cpp
    if (dir.cd("subdirectorio")) {
        // Cambió exitosamente al subdirectorio
    }
    ```
10. ### QString absolutePath() const
    Devuelve la ruta absoluta del directorio representado por el objeto QDir.
    - Retorno: La ruta absoluta como un QString.

    Ejemplo:
    ```cpp
    qDebug() << dir.absolutePath();
    ```
***
## Ejemplo Completo
El siguiente ejemplo lista todos los archivos en el directorio actual:
```cpp
#include <QCoreApplication>
#include <QDir>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QDir dir(QDir::currentPath());  // Crear QDir en el directorio actual
    qDebug() << "Directorio actual:" << dir.absolutePath();

    QStringList archivos = dir.entryList(QDir::Files, QDir::Name);  // Listar archivos ordenados por nombre
    for (const QString &archivo : archivos) {
        qDebug() << archivo;
    }

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Creación de directorios
- Crea una aplicación que solicite al usuario un nombre de directorio, y luego crea ese directorio en el directorio actual si no existe.
2.	### Listar archivos por extensión
- Implementa un programa que liste todos los archivos de una extensión particular (por ejemplo, .txt) dentro de un directorio especificado.
3.	### Mover archivos entre directorios
- Crea una aplicación que permita mover archivos de un directorio a otro, verificando si el archivo ya existe en el destino.
4.	### Eliminar directorios vacíos
- Escribe un programa que recorra un directorio y elimine todos los subdirectorios que estén vacíos.

