---
layout: cabeza3
---

# Clase QDirIterator
La clase QDirIterator en Qt se utiliza para iterar de manera eficiente a través de los archivos y directorios dentro de un directorio dado. Es especialmente útil cuando necesitas listar archivos y carpetas de manera recursiva o aplicar filtros sobre qué elementos deseas iterar.
***
## Características Principales de QDirIterator
- Recorrido de directorios: Permite iterar de manera secuencial a través de los archivos y subdirectorios en un directorio.
- Recursividad: Puedes configurar el iterador para que recorra los subdirectorios recursivamente.
- Filtros de archivos y directorios: Permite aplicar filtros para seleccionar qué tipos de archivos o directorios deben ser iterados.
- Iteración eficiente: La clase está optimizada para evitar cargar toda la lista de archivos a la vez.
***
## Constructores y Métodos Principales
1. ### QDirIterator()
    Constructor predeterminado. Inicia el iterador sin un directorio inicial.

    Ejemplo:
    ```cpp
    QDirIterator it;
    ```
2. ### QDirIterator(const QString &path, QDir::Filters filters = QDir::NoFilter, QDirIterator::IteratorFlags flags = QDirIterator::NoIteratorFlags)
    Crea un iterador para el directorio dado con filtros opcionales y banderas. Puedes aplicar filtros como QDir::Files, QDir::Dirs, QDir::NoDotAndDotDot, etc.
    
    Ejemplo:
    ```cpp
    QDirIterator it("/home/usuario", QDir::Files | QDir::NoSymLinks);
    ```
3. ### QDirIterator::hasNext()
    Comprueba si hay más archivos o directorios por iterar.
    - Retorno: Devuelve true si hay más elementos; de lo contrario, devuelve false.
    
    Ejemplo:
    ```cpp
    while (it.hasNext()) {
        it.next();
        qDebug() << it.fileName();
    }
    ```
4. ### QDirIterator::next()
    Avanza el iterador al siguiente archivo o directorio y devuelve su ruta completa.
    - Retorno: Devuelve la ruta completa del siguiente elemento como un QString.
    
    Ejemplo:
    ```cpp
    QString archivo = it.next();
    qDebug() << archivo;
    ```
5. ### QDirIterator::filePath()
    Devuelve la ruta completa del archivo o directorio actual.
    
    Ejemplo:
    ```cpp
    qDebug() << it.filePath();
    ```
6. ### QDirIterator::fileName()
    Devuelve solo el nombre del archivo o directorio actual (sin la ruta completa).
   
    Ejemplo:
    ```cpp
    qDebug() << it.fileName();
    ```
7. ### QDirIterator::fileInfo()
    Devuelve un objeto QFileInfo que contiene detalles sobre el archivo o directorio actual.

    Ejemplo:
    ```cpp
    QFileInfo info = it.fileInfo();
    qDebug() << info.fileName() << " - " << info.size();
    ```
8. ### QDirIterator::IteratorFlags
    Bandera que especifica el comportamiento del iterador.

    Opciones:
    - QDirIterator::NoIteratorFlags: Itera solo sobre el directorio dado.
    - QDirIterator::Subdirectories: Itera de manera recursiva sobre los subdirectorios.

    Ejemplo:
    ```cpp
    QDirIterator it("/home/usuario", QDir::Files, QDirIterator::Subdirectories);
    ```
***
## Ejemplo Completo
En este ejemplo, se recorre el contenido de un directorio, listando todos los archivos (excluyendo los enlaces simbólicos) y mostrando sus rutas completas:
```cpp
#include <QCoreApplication>
#include <QDirIterator>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QDirIterator it("/home/usuario", QDir::Files | QDir::NoSymLinks, QDirIterator::Subdirectories);

    while (it.hasNext()) {
        qDebug() << it.next();  // Muestra la ruta completa de cada archivo
    }

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Listado de Archivos
- Crea una aplicación que permita seleccionar un directorio mediante QFileDialog::getExistingDirectory(), y luego use QDirIterator para listar todos los archivos en ese directorio, mostrando sus nombres y tamaños.
2.	### Filtrado de Archivos
- Modifica el programa anterior para que solo muestre archivos de cierto tipo (por ejemplo, solo archivos .txt).
3.	### Iteración Recursiva
- Implementa una función que recorra un directorio de manera recursiva, mostrando la estructura de directorios y subdirectorios de forma jerárquica (con sangría para indicar la profundidad de las carpetas).
4.	### Análisis de Archivos
- Crea un programa que, utilizando QDirIterator, recorra todos los archivos de un directorio y sus subdirectorios, y cuente cuántos archivos de cada tipo (por extensión) hay.

