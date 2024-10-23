---
layout: cabeza3
---

# Clase QFileInfo
QFileInfo es una clase en Qt que proporciona información detallada sobre archivos y directorios, como su tamaño, permisos, fechas de modificación, y si son archivos regulares o directorios. Esta clase se utiliza comúnmente para inspeccionar el estado de un archivo o directorio y extraer detalles como su ruta absoluta, el tipo de archivo, y más.
***
## Características Principales de QFileInfo
- Información sobre archivos y directorios: Proporciona detalles como el tamaño, las fechas de acceso y modificación, el tipo de archivo, y si es legible o escribible.
- Rutas de archivo: Ofrece rutas absolutas y relativas, extensiones de archivos y nombres base.
- Interacción con permisos: Permite verificar los permisos de lectura, escritura y ejecución en archivos o directorios.
***
## Métodos Principales de QFileInfo
1. ### QFileInfo()
    Constructor predeterminado que crea un objeto QFileInfo vacío.

    Ejemplo:
    ```cpp
    QFileInfo info;
    ```
2. ### QFileInfo(const QString &file)
    Constructor que crea un QFileInfo a partir de la ruta de un archivo o directorio especificado.

    Ejemplo:
    ```cpp
    QFileInfo info("/home/usuario/archivo.txt");
    ```
3. ### bool exists() const
    Verifica si el archivo o directorio asociado a este QFileInfo existe.
    - Retorno: true si el archivo o directorio existe, false de lo contrario.

    Ejemplo:
    ```cpp
    if (info.exists()) {
        // El archivo o directorio existe
    }
    ```
4. ### QString absoluteFilePath() const
    Devuelve la ruta absoluta completa del archivo o directorio.
    - Retorno: La ruta absoluta como QString.

    Ejemplo:
    ```cpp
    QString ruta = info.absoluteFilePath();
    ```
5. ### QString fileName() const
    Devuelve el nombre base del archivo o directorio (sin la ruta).
    - Retorno: El nombre del archivo o directorio como QString.

    Ejemplo:
    ```cpp
    QString nombreArchivo = info.fileName();
    ```
6. ### qint64 size() const
    Devuelve el tamaño del archivo en bytes. Si es un directorio, devuelve 0.
    - Retorno: Un valor entero que representa el tamaño del archivo.

    Ejemplo:
    ```cpp
    qint64 tamano = info.size();
    ```
7. ### bool isFile() const
    Verifica si QFileInfo representa un archivo regular.
    - Retorno: true si es un archivo, false si es un directorio o no existe.

    Ejemplo:
    ```cpp
    if (info.isFile()) {
        // Es un archivo
    }
    ```
8. ### bool isDir() const
    Verifica si QFileInfo representa un directorio.
    - Retorno: true si es un directorio, false si es un archivo o no existe.
    Ejemplo:
    ```cpp
    if (info.isDir()) {
        // Es un directorio
    }
    ```
9. ### bool isReadable() const
    Verifica si el archivo o directorio es legible.
    - Retorno: true si es legible, false de lo contrario.
    
    Ejemplo:
    ```cpp
    if (info.isReadable()) {
        // El archivo o directorio es legible
    }
    ```
10. ### bool isWritable() const
    Verifica si el archivo o directorio es escribible.
    - Retorno: true si es escribible, false de lo contrario.

    Ejemplo:
    ```cpp
    if (info.isWritable()) {
        // El archivo o directorio es escribible
    }
    ```
11. ### QDateTime lastModified() const
    Devuelve la fecha y hora de la última modificación del archivo o directorio.
    - Retorno: Un objeto QDateTime que representa la fecha y hora de la última modificación.

    Ejemplo:
    ```cpp
    QDateTime modificado = info.lastModified();
    ```
12. ### QString suffix() const
    Devuelve la extensión del archivo (el sufijo después del punto, por ejemplo, "txt" para un archivo de texto).
    - Retorno: Un QString con la extensión del archivo.

    Ejemplo:
    ```cpp
    QString extension = info.suffix();
    ```
13. ### QString baseName() const
    Devuelve el nombre base del archivo sin la extensión.
    - Retorno: Un QString con el nombre base del archivo.

    Ejemplo:
    ```cpp
    QString nombreBase = info.baseName();
    ```
14. ### bool isExecutable() const
    Verifica si el archivo es ejecutable.
    - Retorno: true si el archivo es ejecutable, false de lo contrario.

    Ejemplo:
    ```cpp
    if (info.isExecutable()) {
        // El archivo es ejecutable
    }
    ```
***
## Ejemplo Completo
El siguiente ejemplo muestra cómo obtener información detallada de un archivo utilizando QFileInfo:
```cpp
#include <QCoreApplication>
#include <QFileInfo>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QFileInfo fileInfo("/path/to/file.txt");

    qDebug() << "Nombre del archivo:" << fileInfo.fileName();
    qDebug() << "Ruta absoluta:" << fileInfo.absoluteFilePath();
    qDebug() << "Tamaño:" << fileInfo.size() << "bytes";
    qDebug() << "Última modificación:" << fileInfo.lastModified();
    qDebug() << "Es archivo:" << fileInfo.isFile();
    qDebug() << "Es directorio:" << fileInfo.isDir();
    qDebug() << "Es legible:" << fileInfo.isReadable();
    qDebug() << "Es escribible:" << fileInfo.isWritable();
    qDebug() << "Extensión:" << fileInfo.suffix();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Inspección de archivos
- Implementa un programa que solicite al usuario la ruta de un archivo, y luego muestre toda la información posible utilizando QFileInfo (nombre, tamaño, permisos, fecha de modificación, etc.).
2.	### Verificación de permisos
- Crea una aplicación que lea un directorio y verifique qué archivos en ese directorio son legibles, escribibles y ejecutables.
3.	### Comparación de fechas de modificación
- Implementa un programa que compare dos archivos y determine cuál fue modificado más recientemente utilizando el método lastModified() de QFileInfo.
4.	### Listado de archivos con extensión
- Crea una aplicación que liste todos los archivos en un directorio con una extensión específica (por ejemplo, ".txt" o ".cpp") usando QFileInfo.

