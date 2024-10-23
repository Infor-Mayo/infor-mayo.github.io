---
layout: cabeza3
---


# Clase QDialog
QDialog es la base de muchos diálogos estándar en Qt, como cuadros de diálogo de archivos, mensajes de error, o formularios de confirmación. Los diálogos modales impiden la interacción con otras ventanas hasta que el diálogo sea cerrado, mientras que los diálogos no modales permiten interactuar con la aplicación mientras están abiertos.
***
## Funcionalidades clave de QDialog
1. ### Crear un QDialog básico
    Para crear un diálogo, heredas de QDialog o creas una instancia directa de él. Puedes añadir widgets, como botones o campos de entrada, para interactuar con el usuario.

    Ejemplo:
    ```cpp
    QDialog *dialog = new QDialog(this);
    dialog->setWindowTitle("Diálogo Simple");
    dialog->exec();  // Abre el diálogo en modo modal
    ```
2. ### Diálogo Modal vs No Modal
    Un diálogo modal bloquea la interacción con otras ventanas hasta que es cerrado. Puedes controlar si el diálogo es modal o no con:
    - setModal(bool modal): Si es true, el diálogo será modal.
    - exec(): Abre el diálogo de manera modal, bloqueando la interacción con otras ventanas.
    - show(): Abre el diálogo de manera no modal, permitiendo interacción con otras ventanas.

    Ejemplo:
    ```cpp
    QDialog *modalDialog = new QDialog(this);
    modalDialog->setModal(true);  // Hacer modal
    modalDialog->exec();  // Modal hasta que se cierre
    ```
3. ### Botones de acción y aceptación
    En muchos diálogos, como los formularios o cuadros de confirmación, es común tener botones para aceptar o cancelar la acción. Qt proporciona botones estándar como QDialogButtonBox.
    - QDialogButtonBox: Proporciona un conjunto de botones estandarizados, como "OK", "Cancel", etc.
    - accept(): Indica que el diálogo fue aceptado (equivalente a hacer clic en "OK").
    - reject(): Indica que el diálogo fue rechazado o cancelado.
    - done(int result): Finaliza el diálogo con un código de resultado.

    Ejemplo:
    ```cpp
    QDialog *dialog = new QDialog(this);
    QDialogButtonBox *buttonBox = new QDialogButtonBox(QDialogButtonBox::Ok | QDialogButtonBox::Cancel);

    connect(buttonBox, &QDialogButtonBox::accepted, dialog, &QDialog::accept);
    connect(buttonBox, &QDialogButtonBox::rejected, dialog, &QDialog::reject);

    QVBoxLayout *layout = new QVBoxLayout;
    layout->addWidget(buttonBox);
    dialog->setLayout(layout);

    dialog->exec();  // Modal
    ```
4. ### Recibir datos del usuario
    Puedes utilizar varios widgets de entrada como QLineEdit, QComboBox, etc., dentro de un diálogo para recopilar datos del usuario. Usualmente, se muestran botones de aceptar o cancelar para confirmar o descartar los datos ingresados.
    
    Ejemplo:
    ```cpp
    QDialog *inputDialog = new QDialog(this);
    QLineEdit *lineEdit = new QLineEdit(inputDialog);
    QDialogButtonBox *buttonBox = new QDialogButtonBox(QDialogButtonBox::Ok | QDialogButtonBox::Cancel);

    connect(buttonBox, &QDialogButtonBox::accepted, inputDialog, &QDialog::accept);
    connect(buttonBox, &QDialogButtonBox::rejected, inputDialog, &QDialog::reject);

    QVBoxLayout *layout = new QVBoxLayout;
    layout->addWidget(lineEdit);
    layout->addWidget(buttonBox);
    inputDialog->setLayout(layout);

    if (inputDialog->exec() == QDialog::Accepted) {
        QString inputText = lineEdit->text();
        qDebug() << "Texto ingresado:" << inputText;
    }
    ```
5. ### Mensajes de advertencia o información
    Qt ofrece cuadros de diálogo predefinidos para mostrar mensajes de información, advertencia o error al usuario, como QMessageBox.

    Ejemplo:
    ```cpp
    QMessageBox::information(this, "Información", "Este es un mensaje de información.");
    QMessageBox::warning(this, "Advertencia", "Este es un mensaje de advertencia.");
    QMessageBox::critical(this, "Error", "Este es un mensaje de error.");
    ```
6. ### Finalizar el diálogo con un resultado personalizado
    Puedes finalizar el diálogo y devolver un resultado personalizado, que puede ser evaluado por la aplicación llamante.
    - done(int result): Finaliza el diálogo y devuelve el valor result.

    Ejemplo:
    ```cpp
    dialog->done(42);  // El diálogo finaliza y devuelve 42
    ```
***
## Ejemplos prácticos
1. ### Crear un QDialog con campos de texto y botones
```cpp
#include <QApplication>
#include <QDialog>
#include <QVBoxLayout>
#include <QLineEdit>
#include <QDialogButtonBox>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QDialog *dialog = new QDialog;
    dialog->setWindowTitle("Formulario de Entrada");

    QLineEdit *lineEdit = new QLineEdit;
    lineEdit->setPlaceholderText("Ingrese su nombre");

    QDialogButtonBox *buttonBox = new QDialogButtonBox(QDialogButtonBox::Ok | QDialogButtonBox::Cancel);
    connect(buttonBox, &QDialogButtonBox::accepted, dialog, &QDialog::accept);
    connect(buttonBox, &QDialogButtonBox::rejected, dialog, &QDialog::reject);

    QVBoxLayout *layout = new QVBoxLayout;
    layout->addWidget(lineEdit);
    layout->addWidget(buttonBox);
    dialog->setLayout(layout);

    if (dialog->exec() == QDialog::Accepted) {
        QString name = lineEdit->text();
        qDebug() << "Nombre ingresado:" << name;
    }

    return app.exec();
}
```
2. ### Crear un cuadro de diálogo modal con un botón "OK" y "Cancel"
```cpp
#include <QApplication>
#include <QDialog>
#include <QDialogButtonBox>
#include <QVBoxLayout>
#include <QLabel>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QDialog *dialog = new QDialog;
    dialog->setWindowTitle("Diálogo de Confirmación");

    QLabel *label = new QLabel("¿Está seguro de que desea continuar?");
    QDialogButtonBox *buttonBox = new QDialogButtonBox(QDialogButtonBox::Ok | QDialogButtonBox::Cancel);

    connect(buttonBox, &QDialogButtonBox::accepted, dialog, &QDialog::accept);
    connect(buttonBox, &QDialogButtonBox::rejected, dialog, &QDialog::reject);

    QVBoxLayout *layout = new QVBoxLayout;
    layout->addWidget(label);
    layout->addWidget(buttonBox);
    dialog->setLayout(layout);

    int result = dialog->exec();  // Modal
    if (result == QDialog::Accepted) {
        qDebug() << "Confirmado.";
    } else {
        qDebug() << "Cancelado.";
    }

    return app.exec();
}
```
3. ### Cuadro de mensaje usando QMessageBox
```cpp
#include <QApplication>
#include <QMessageBox>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QMessageBox::information(nullptr, "Información", "Este es un cuadro de mensaje informativo.");
    QMessageBox::warning(nullptr, "Advertencia", "Este es un cuadro de mensaje de advertencia.");
    QMessageBox::critical(nullptr, "Error", "Este es un cuadro de mensaje de error.");

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	Formulario de inicio de sesión:
- Crea un cuadro de diálogo modal que actúe como formulario de inicio de sesión con campos de "Usuario" y "Contraseña". Incluye botones "Iniciar sesión" y "Cancelar". Verifica si el usuario ingresó "admin" como usuario y "1234" como contraseña, mostrando un mensaje de éxito o error.
2.	Confirmación de cierre:
- Crea una aplicación que muestre un cuadro de diálogo de confirmación cuando el usuario intente cerrar la ventana principal. Si el usuario confirma, la aplicación se cierra, de lo contrario, permanece abierta.
3.	Cuadro de diálogo de preferencias:
- Crea un cuadro de diálogo con varios controles (QCheckBox, QRadioButton, QComboBox, etc.) para que el usuario configure preferencias de la aplicación. Guarda las preferencias si el usuario hace clic en "Aceptar" o descarta los cambios si hace clic en "Cancelar".
4.	Selector de archivos:
- Usa QFileDialog para abrir un cuadro de diálogo que permita seleccionar un archivo de imagen. Muestra la imagen seleccionada en un QLabel dentro de otro cuadro de diálogo.
5.	Cuadro de mensaje personalizado:
- Implementa un cuadro de mensaje personalizado que permita al usuario ingresar una respuesta a una pregunta y muestre un mensaje dependiendo de la respuesta ingresada.
***
QDialog es clave para crear ventanas de interacción específicas, como cuadros de confirmación o formularios. 

