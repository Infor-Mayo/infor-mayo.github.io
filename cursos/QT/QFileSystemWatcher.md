---
layout: cabeza3
---

# Clase QFileSystemWatcher
QFileSystemWatcher es una clase en Qt que permite monitorizar cambios en archivos o directorios del sistema de archivos en tiempo real. Utiliza señales para notificar cuando un archivo o directorio es modificado, agregado o eliminado. Es particularmente útil en aplicaciones que necesitan actualizarse automáticamente cuando el contenido del sistema de archivos cambia, como editores de texto o administradores de archivos.
***
## Características Principales de QFileSystemWatcher
- Monitorización de Archivos: Puede observar archivos individuales para detectar cambios como modificaciones, eliminación o renombrado.
- Monitorización de Directorios: Puede observar directorios completos para detectar cambios en cualquier archivo dentro del directorio.
- Soporte en Tiempo Real: Utiliza señales para notificar cambios en tiempo real sin necesidad de una consulta continua.
***
## Métodos Principales de QFileSystemWatcher
1. ### Constructor
    Inicializa un QFileSystemWatcher vacío o con una lista de archivos y directorios para monitorizar.
    ```cpp
    QFileSystemWatcher(QObject *parent = nullptr);
    QFileSystemWatcher(const QStringList &paths, QObject *parent = nullptr);
    ```
    - paths: Lista de rutas a archivos o directorios que se deben monitorizar desde el principio.
    - parent: El widget padre que será propietario del objeto (opcional).

    Ejemplo:
    ```cpp
    QFileSystemWatcher *watcher = new QFileSystemWatcher();
    ```
2. ### addPath()
    Añade una ruta de archivo o directorio a la lista de elementos monitorizados.
    ```cpp
    void addPath(const QString &path);
    ```
    - path: La ruta al archivo o directorio que se quiere observar.

    Ejemplo:
    ```cpp
    watcher->addPath("/ruta/al/archivo.txt");
    ```
3. ### addPaths()
    Añade una lista de rutas de archivos o directorios para monitorizar.
    ```cpp
    void addPaths(const QStringList &paths);
    ```
    - paths: Lista de rutas de archivos o directorios.

    Ejemplo:
    ```cpp
    watcher->addPaths(QStringList() << "/ruta/al/archivo1.txt" << "/ruta/al/archivo2.txt");
    ```
4. ### removePath()
    Elimina una ruta de archivo o directorio de la lista de elementos monitorizados.
    ```cpp
    void removePath(const QString &path);
    ```
    - path: La ruta al archivo o directorio que se desea dejar de observar.

    Ejemplo:
    ```cpp
    watcher->removePath("/ruta/al/archivo.txt");
    ```
5. ### removePaths()
    Elimina una lista de rutas de archivos o directorios de la lista de elementos monitorizados.
    ```cpp
    void removePaths(const QStringList &paths);
    ```
    - paths: Lista de rutas de archivos o directorios que se desean dejar de observar.

    Ejemplo:
    ```cpp
    watcher->removePaths(QStringList() << "/ruta/al/archivo1.txt" << "/ruta/al/archivo2.txt");
    ```
6. ### files()
    Devuelve una lista de archivos que están siendo monitorizados.
    ```cpp
    QStringList files() const;
    ```

    Ejemplo:
    ```cpp
    QStringList monitoredFiles = watcher->files();
    ```
7. ### directories()
    Devuelve una lista de directorios que están siendo monitorizados.
    ```cpp
    QStringList directories() const;
    ```

    Ejemplo:
    ```cpp
    QStringList monitoredDirectories = watcher->directories();
    ```
***
## Señales Importantes
1. ### fileChanged()
    Esta señal es emitida cuando el archivo especificado ha sido modificado, eliminado o renombrado.
    ```cpp
    void fileChanged(const QString &path);
    ```
    - path: La ruta del archivo que ha sido modificado o eliminado.

    Ejemplo:
    ```cpp
    connect(watcher, &QFileSystemWatcher::fileChanged, this, [](const QString &path) {
        qDebug() << "El archivo ha cambiado:" << path;
    });
    ```
2. ### directoryChanged()
    Esta señal es emitida cuando el contenido del directorio especificado ha cambiado.
    ```cpp
    void directoryChanged(const QString &path);
    ```
    - path: La ruta del directorio que ha cambiado.

    Ejemplo:
    ```cpp
    connect(watcher, &QFileSystemWatcher::directoryChanged, this, [](const QString &path) {
        qDebug() << "El directorio ha cambiado:" << path;
    });
    ```
***
## Ejemplo Completo de Uso de QFileSystemWatcher
A continuación, un ejemplo que muestra cómo usar QFileSystemWatcher para monitorizar un archivo y un directorio.
```cpp
#include <QApplication>
#include <QFileSystemWatcher>
#include <QDebug>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QFileSystemWatcher watcher;

    // Añadir archivo y directorio a la lista de observación
    watcher.addPath("/ruta/al/archivo.txt");
    watcher.addPath("/ruta/al/directorio");

    // Conectar las señales a los slots
    QObject::connect(&watcher, &QFileSystemWatcher::fileChanged, [](const QString &path) {
        qDebug() << "El archivo ha cambiado:" << path;
    });

    QObject::connect(&watcher, &QFileSystemWatcher::directoryChanged, [](const QString &path) {
        qDebug() << "El directorio ha cambiado:" << path;
    });

    return app.exec();
}
```
Este ejemplo monitoriza tanto un archivo como un directorio y emite mensajes cuando hay cambios en el sistema de archivos.
***
## Ejercicios de Consolidación
1.	### Monitorización de Archivos
- Crea una aplicación que monitorice varios archivos de texto en tu sistema. Cuando un archivo sea modificado, la aplicación debe imprimir en la consola un mensaje indicando qué archivo ha cambiado.
2.	### Monitorización de Directorios
- Escribe una aplicación que observe un directorio específico y muestre un mensaje cada vez que se añada, elimine o modifique un archivo en ese directorio.
3.	### Actualización de Vista de Directorio
- Implementa una interfaz gráfica en la que una QListWidget muestre los archivos de un directorio. Usa QFileSystemWatcher para actualizar la lista automáticamente cuando se agreguen o eliminen archivos en ese directorio.
4.	### Monitorización Dinámica
- Escribe un programa que permita al usuario agregar o eliminar archivos y directorios para monitorizar usando QFileSystemWatcher. La lista de elementos monitorizados debe actualizarse dinámicamente y mostrar cambios en la interfaz.
***
Con QFileSystemWatcher, puedes construir aplicaciones reactivas que respondan a cambios en archivos y directorios, ofreciendo una experiencia de usuario más dinámica y adaptable.

