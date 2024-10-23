---
layout: cabeza3
---

# Clase QCheckBox
QCheckBox proporciona una casilla de verificación con una etiqueta de texto al lado. Permite controlar si está marcada, desmarcada o en un estado intermedio (tristado). Además, emite señales cuando cambia su estado, lo que permite reaccionar a las acciones del usuario.

***

## Funcionalidades clave de QCheckBox
1. ### Constructores
    - QCheckBox(QWidget *parent = nullptr): Crea una casilla de verificación vacía sin texto.
    - QCheckBox(const QString &text, QWidget *parent = nullptr): Crea una casilla de verificación con una etiqueta de texto.

    Ejemplo:
    ```cpp
    QCheckBox *checkBox = new QCheckBox("Aceptar términos y condiciones", this);
    ```
2. ### Verificar el estado
    QCheckBox tiene tres posibles estados:
    - Marcado (Qt::Checked)
    - No marcado (Qt::Unchecked)
    - Tristado o estado intermedio (Qt::PartiallyChecked), que se puede habilitar cuando se requiere un tercer estado.
    - isChecked(): Devuelve true si el checkbox está marcado.
    - setChecked(bool checked): Establece el estado marcado o desmarcado.
    - checkState(): Devuelve el estado actual del QCheckBox (Qt::Checked, Qt::Unchecked, Qt::PartiallyChecked).
    - setCheckState(Qt::CheckState state): Cambia el estado de la casilla de verificación.

    Ejemplo:
    ```cpp
    QCheckBox *checkBox = new QCheckBox("Mostrar notificaciones", this);
    if (checkBox->isChecked()) {
        // Realizar acción si está marcado
    }
    ```
3. ### Estado tristado (intermedio)
    Puedes habilitar un estado intermedio en el checkbox, comúnmente usado cuando quieres reflejar que solo una parte de una serie de opciones está seleccionada.
    - setTristate(bool tristate = true): Habilita o deshabilita el estado intermedio (tristado).

    Ejemplo:
    ```cpp
    QCheckBox *checkBox = new QCheckBox("Estado intermedio permitido", this);
    checkBox->setTristate(true);  // Habilitar el estado intermedio
    checkBox->setCheckState(Qt::PartiallyChecked);  // Establecer el estado intermedio
    ```
4. ### Conectar señales
    QCheckBox emite señales cuando cambia su estado. Las señales más importantes son:
    - toggled(bool checked): Emitida cuando el estado de la casilla cambia.
    - stateChanged(int state): Emitida cuando el estado de la casilla cambia a Qt::Checked, Qt::Unchecked o Qt::PartiallyChecked.

    Ejemplo:
    ```cpp
    QCheckBox *checkBox = new QCheckBox("Habilitar opciones avanzadas", this);
    connect(checkBox, &QCheckBox::toggled, this, [](bool checked) {
        if (checked) {
            qDebug() << "Opciones avanzadas habilitadas";
        } else {
            qDebug() << "Opciones avanzadas deshabilitadas";
        }
    });
    ```
5. ### Texto en la etiqueta
    Puedes cambiar o establecer el texto que acompaña al QCheckBox.
    - setText(const QString &text): Establece el texto de la etiqueta.
    - text(): Devuelve el texto actual de la etiqueta.

    Ejemplo:
    ```cpp
    QCheckBox *checkBox = new QCheckBox(this);
    checkBox->setText("Aceptar política de privacidad");
    ```
6. ### Estados visuales
Al igual que otros widgets en Qt, puedes modificar el estilo y los estados visuales de un QCheckBox mediante hojas de estilo (QSS) o métodos como setStyleSheet().

***

## Ejemplos prácticos
1. ### Casilla de verificación básica
```cpp
#include <QApplication>
#include <QCheckBox>
#include <QVBoxLayout>
#include <QWidget>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QCheckBox *checkBox = new QCheckBox("Aceptar términos y condiciones");
    layout.addWidget(checkBox);

    window.setLayout(&layout);
    window.show();

    return app.exec();
}
```
2. ### Manejar el cambio de estado
```cpp
#include <QApplication>
#include <QCheckBox>
#include <QMessageBox>
#include <QVBoxLayout>
#include <QWidget>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QCheckBox *checkBox = new QCheckBox("Habilitar notificaciones");
    layout.addWidget(checkBox);

    QObject::connect(checkBox, &QCheckBox::toggled, [&](bool checked) {
        if (checked) {
            QMessageBox::information(&window, "Notificaciones", "Notificaciones habilitadas");
        } else {
            QMessageBox::information(&window, "Notificaciones", "Notificaciones deshabilitadas");
        }
    });

    window.setLayout(&layout);
    window.show();

    return app.exec();
}
```
3. ### Estado intermedio (tristado)
```cpp
#include <QApplication>
#include <QCheckBox>
#include <QVBoxLayout>
#include <QWidget>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QCheckBox *checkBox = new QCheckBox("Seleccionar parcialmente");
    checkBox->setTristate(true);  // Habilitar estado tristado
    checkBox->setCheckState(Qt::PartiallyChecked);  // Establecer estado intermedio
    layout.addWidget(checkBox);

    window.setLayout(&layout);
    window.show();

    return app.exec();
}
```

***

## Ejercicios de Consolidación
1.	Formulario de preferencias:
- Crea un formulario con varias casillas de verificación para que el usuario pueda seleccionar diferentes preferencias, como habilitar notificaciones, activar modo oscuro y recibir boletines informativos. Cambia el comportamiento de la aplicación dependiendo de las selecciones.
2.	Casilla de verificación intermedia:
- Diseña una aplicación donde un checkbox padre controla varias casillas hijas (por ejemplo, seleccionar o deseleccionar todas las opciones). Usa el estado tristado para reflejar si algunas, pero no todas, las casillas hijas están seleccionadas.
3.	Validación de formularios:
- Crea un formulario que tenga un botón de enviar deshabilitado hasta que el usuario haya marcado una casilla que dice "Acepto los términos y condiciones". Habilita el botón cuando el checkbox esté marcado.
4.	Cambio de estilo dinámico:
- Implementa una casilla de verificación que al estar marcada cambia el estilo de otros widgets en la aplicación (por ejemplo, cambiar el color de fondo o el estilo de los botones).

***

Esta es una introducción a las funcionalidades más importantes de QCheckBox.

