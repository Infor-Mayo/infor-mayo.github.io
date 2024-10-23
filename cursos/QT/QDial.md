---
layout: cabeza3
---

# Clase QDial
QDial es un widget en Qt que proporciona una interfaz gráfica en forma de dial rotativo, el cual permite a los usuarios seleccionar un valor dentro de un rango mediante la rotación de la perilla. QDial es útil para simular controles como perillas de volumen, selectores de temperatura o cualquier otra funcionalidad que requiera un control continuo dentro de un rango de valores.
***
## Características Principales
- Rango ajustable: Permite configurar un valor mínimo y máximo.
- Marcadores opcionales: Puede mostrar pequeños marcadores alrededor del dial para indicar el progreso.
- Envolvimiento opcional: Si se habilita, el dial "envuelve" los valores al llegar al límite máximo, volviendo al valor mínimo y viceversa.
- Personalizable: Se puede ajustar el comportamiento visual del dial, incluyendo los pasos del valor, el grosor de los marcadores y la sensibilidad de rotación.
***
## Métodos Principales de QDial
1. ### QDial(QWidget *parent = nullptr)
    Constructor que crea un widget QDial.

    Parámetros:
    - parent: El widget padre (opcional).

    Ejemplo:
    ```cpp
    QDial *dial = new QDial();
    ```
2. ### int value() const
    Devuelve el valor actual del dial.

    Ejemplo:
    ```cpp
    int currentValue = dial->value();
    ```
3. ### void setValue(int value)
    Establece el valor actual del dial.

    Parámetros:
    - value: El valor a establecer.

    Ejemplo:
    ```cpp
    dial->setValue(50);
    ```
4. ### int minimum() const
    Devuelve el valor mínimo que puede tomar el dial.

    Ejemplo:
    ```cpp
    int min = dial->minimum();
    ```
5. ### void setMinimum(int min)
    Establece el valor mínimo del dial.

    Parámetros:
    - min: El valor mínimo a establecer.

    Ejemplo:
    ```cpp
    dial->setMinimum(0);
    ```
6. ### int maximum() const
    Devuelve el valor máximo que puede tomar el dial.

    Ejemplo:
    ```cpp
    int max = dial->maximum();
    ```
7. ### void setMaximum(int max)
    Establece el valor máximo del dial.

    Parámetros:
    - max: El valor máximo a establecer.

    Ejemplo:
    ```cpp
    dial->setMaximum(100);
    ```
8. ### void setRange(int min, int max)
    Establece el rango de valores permitidos en el dial.

    Parámetros:
    - min: Valor mínimo.
    - max: Valor máximo.

    Ejemplo:
    ```cpp
    dial->setRange(0, 100);
    ```
9. ### int singleStep() const
    Devuelve el tamaño del paso que el valor incrementa o decrementa cuando se mueve el dial.

    Ejemplo:
    ```cpp
    int step = dial->singleStep();
    ```
10. ### void setSingleStep(int step)
    Establece el tamaño del paso.

    Parámetros:
    - step: El tamaño del paso.

    Ejemplo:
    ```cpp
    dial->setSingleStep(5);
    ```
11. ### bool wrapping() const
    Devuelve si la funcionalidad de envoltura está activada. Si está activada, al llegar al máximo se volverá al mínimo.

    Ejemplo:
    ```cpp
    bool isWrapping = dial->wrapping();
    ```
12. ### void setWrapping(bool on)
    Activa o desactiva la funcionalidad de envoltura.

    Parámetros:
    - on: true para activar la envoltura, false para desactivarla.

    Ejemplo:
    ```cpp
    dial->setWrapping(true);
    ```
13. ### bool notchesVisible() const
    Devuelve si los pequeños marcadores (notches) son visibles alrededor del dial.

    Ejemplo:
    ```cpp
    bool visibleNotches = dial->notchesVisible();
    ```
14. ### void setNotchesVisible(bool visible)
    Activa o desactiva la visualización de los marcadores en el dial.

    Parámetros:
    - visible: true para mostrar los marcadores, false para ocultarlos.

    Ejemplo:
    ```cpp
    dial->setNotchesVisible(true);
    ```
***
## Señales Principales
1. ### valueChanged(int value)
Esta señal se emite cuando el valor del dial cambia.

Ejemplo:
```cpp
connect(dial, &QDial::valueChanged, [](int value) {
    qDebug() << "Valor del dial cambiado a:" << value;
});
```
2. ### sliderPressed()
Esta señal se emite cuando el usuario presiona el dial.

Ejemplo:
```cpp
connect(dial, &QDial::sliderPressed, []() {
    qDebug() << "El dial ha sido presionado";
});
```
3. ### sliderReleased()
Esta señal se emite cuando el usuario libera el dial.

Ejemplo:
```cpp
connect(dial, &QDial::sliderReleased, []() {
    qDebug() << "El dial ha sido liberado";
});
```
***
## Ejemplo Completo
Aquí tienes un ejemplo completo de cómo utilizar QDial:
```cpp
#include <QApplication>
#include <QDial>
#include <QVBoxLayout>
#include <QLabel>
#include <QWidget>

class DialExample : public QWidget {
public:
    DialExample(QWidget *parent = nullptr) : QWidget(parent) {
        QVBoxLayout *layout = new QVBoxLayout(this);

        QLabel *label = new QLabel("Valor del dial: 0", this);
        QDial *dial = new QDial(this);
        dial->setRange(0, 100);
        dial->setNotchesVisible(true);
        dial->setWrapping(true);

        layout->addWidget(label);
        layout->addWidget(dial);

        connect(dial, &QDial::valueChanged, label, [label](int value) {
            label->setText("Valor del dial: " + QString::number(value));
        });
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    DialExample window;
    window.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	Ejercicio 1: Control de Volumen
- Crea un QDial que simule un control de volumen entre 0 y 100. Usa una etiqueta para mostrar el valor actual del volumen.
2.	Ejercicio 2: Selector de Temperatura
- Implementa un QDial para seleccionar la temperatura en un rango de 15°C a 30°C, con un paso de 0.5°C. Muestra el valor seleccionado en una etiqueta.
3.	Ejercicio 3: Dial con Envoltura
- Crea un QDial con un rango de 0 a 360 (grados), donde el dial envuelva al llegar a 360 y vuelva a 0. Muestra el valor en una etiqueta.
4.	Ejercicio 4: Selector de Brillo
- Usa un QDial para permitir al usuario seleccionar el nivel de brillo entre 0 y 100, con un paso de 5. Cuando el valor cambie, actualiza una etiqueta con el valor.
