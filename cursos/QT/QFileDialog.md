---
layout: cabeza3
---

# Clase QFileDialog
QFileDialog es una clase en Qt que proporciona una interfaz gráfica para que el usuario seleccione archivos o directorios. Esta clase permite abrir, guardar y navegar a través del sistema de archivos, facilitando la interacción del usuario con la gestión de archivos de manera amigable y visual.
***
## Características Principales de QFileDialog
- Selección de archivos y directorios: Permite al usuario seleccionar uno o más archivos o directorios.
- Filtros de archivos: Puedes aplicar filtros para mostrar solo ciertos tipos de archivos (por ejemplo, archivos de texto o imágenes).
- Modos de apertura y guardado: Funciona tanto para abrir archivos como para guardar archivos con nombres especificados por el usuario.
- Modos de selección múltiple: Permite la selección de varios archivos a la vez.
***
## Métodos Principales de QFileDialog
1. ### QFileDialog()
    Constructor predeterminado. 
    Crea un cuadro de diálogo de selección de archivos vacío.

    Ejemplo:
    ```cpp
    QFileDialog dialog;
    ```
2. ### QFileDialog::getOpenFileName()
    Abre un cuadro de diálogo que permite al usuario seleccionar un archivo para abrir.
    - Parámetros: La ruta inicial y un filtro opcional para los tipos de archivos.
    - Retorno: Devuelve la ruta completa del archivo seleccionado como un QString. Si el usuario cancela, devuelve una cadena vacía.

    Ejemplo:
    ```cpp
    QString archivo = QFileDialog::getOpenFileName(nullptr, "Abrir archivo", "/home/usuario", "Archivos de texto (*.txt);;Todos los archivos (*)");
    ```
3. ### QFileDialog::getOpenFileNames()
    Abre un cuadro de diálogo que permite al usuario seleccionar varios archivos para abrir.
    - Retorno: Devuelve una lista de rutas de archivos seleccionados como QStringList. Si el usuario cancela, devuelve una lista vacía.

    Ejemplo:
    ```cpp
    QStringList archivos = QFileDialog::getOpenFileNames(nullptr, "Seleccionar archivos", "/home/usuario", "Imágenes (*.png *.jpg);;Todos los archivos (*)");
    ```
4. ### QFileDialog::getSaveFileName()
    Abre un cuadro de diálogo que permite al usuario seleccionar un archivo o especificar un nombre de archivo para guardar.
    - Retorno: Devuelve la ruta completa del archivo seleccionado o guardado como QString. Si el usuario cancela, devuelve una cadena vacía.

    Ejemplo:
    ```cpp
    QString archivo = QFileDialog::getSaveFileName(nullptr, "Guardar archivo", "/home/usuario/documento.txt", "Archivos de texto (*.txt);;Todos los archivos (*)");
    ```
5. ### QFileDialog::getExistingDirectory()
    Abre un cuadro de diálogo que permite al usuario seleccionar un directorio existente.
    - Retorno: Devuelve la ruta del directorio seleccionado como QString. Si el usuario cancela, devuelve una cadena vacía.

    Ejemplo:
    ```cpp
    QString directorio = QFileDialog::getExistingDirectory(nullptr, "Seleccionar directorio", "/home/usuario");
    ```
6. ### void setFileMode(QFileDialog::FileMode mode)
    Establece el modo de selección del diálogo (puede ser para seleccionar un archivo, directorios o varios archivos).

    Ejemplo:
    ```cpp
    dialog.setFileMode(QFileDialog::ExistingFiles);
    ```
7. ### void setNameFilter(const QString &filter)
    Aplica un filtro para mostrar solo archivos que coincidan con el patrón dado (por ejemplo, ".txt" o ".jpg").

    Ejemplo:
    ```cpp
    dialog.setNameFilter("Imágenes (*.png *.jpg)");
    ```
8. ### void setDirectory(const QString &directory)
    Establece el directorio inicial donde se abrirá el cuadro de diálogo.

    Ejemplo:
    ```cpp
    dialog.setDirectory("/home/usuario");
    ```
9. ### void setAcceptMode(QFileDialog::AcceptMode mode)
    Establece el modo de aceptación del diálogo. Puede ser QFileDialog::AcceptOpen para abrir archivos o QFileDialog::AcceptSave para guardarlos.

    Ejemplo:
    ```cpp
    dialog.setAcceptMode(QFileDialog::AcceptSave);
    ```
***
## Ejemplo Completo
En este ejemplo, se abre un cuadro de diálogo que permite seleccionar un archivo de texto para su lectura:
```cpp
#include <QCoreApplication>
#include <QFileDialog>
#include <QDebug>
#include <QFile>
#include <QTextStream>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QString archivo = QFileDialog::getOpenFileName(nullptr, "Abrir archivo", "/home/usuario", "Archivos de texto (*.txt)");

    if (!archivo.isEmpty()) {
        QFile file(archivo);
        if (file.open(QIODevice::ReadOnly)) {
            QTextStream in(&file);
            QString contenido = in.readAll();
            qDebug() << "Contenido del archivo:";
            qDebug() << contenido;
            file.close();
        }
    } else {
        qDebug() << "No se seleccionó ningún archivo.";
    }

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	###  Selección de múltiples archivos
- Crea una aplicación que permita seleccionar múltiples archivos y luego mostrar sus nombres y rutas completas en una lista.
2.	###  Guardar un archivo
- Implementa un programa que permita al usuario escribir texto en un cuadro de entrada y luego abrir un cuadro de diálogo para guardar ese texto en un archivo utilizando QFileDialog::getSaveFileName().
3.	### Selección de directorios
- Crea una aplicación que permita seleccionar un directorio mediante QFileDialog::getExistingDirectory() y luego liste todos los archivos y subdirectorios dentro de ese directorio.
4.	### Filtro de tipos de archivos
- Implementa un programa que permita abrir un cuadro de diálogo para seleccionar archivos de imagen (por ejemplo, ".png", ".jpg") y luego muestre solo los archivos que coincidan con el filtro especificado.

