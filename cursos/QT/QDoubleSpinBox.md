---
layout: cabeza3
---

# Clase QDoubleSpinBox
QDoubleSpinBox es una versión especializada de QSpinBox que permite la selección de números de punto flotante (decimales). Al igual que QSpinBox, los valores se pueden incrementar o decrementar mediante flechas, pero QDoubleSpinBox proporciona mayor control sobre los decimales, el rango y el paso.
***
## Características Principales
- Permite al usuario ingresar números de punto flotante mediante flechas o escribiéndolos directamente.
- Se pueden configurar el número de decimales a mostrar, el rango de valores, y el paso de incremento/decremento.
- Soporta señales para detectar cambios en el valor.
- Permite establecer prefijos y sufijos para personalizar la presentación del valor.
***
## Métodos Principales de QDoubleSpinBox
1. ### QDoubleSpinBox(QWidget *parent = nullptr)
    Constructor que crea un widget QDoubleSpinBox.

    Parámetros:
    - parent: El widget padre (opcional).

    Ejemplo:
    ```cpp
    QDoubleSpinBox *doubleSpinBox = new QDoubleSpinBox();
    ```
2. ### double minimum() const
    Devuelve el valor mínimo permitido en el QDoubleSpinBox.

    Ejemplo:
    ```cpp
    double min = doubleSpinBox->minimum();
    ```
3. ### void setMinimum(double)
    Establece el valor mínimo permitido en el QDoubleSpinBox.

    Parámetros:
    - double: El valor mínimo.

    Ejemplo:
    ```cpp
    doubleSpinBox->setMinimum(0.0);
    ```
4. ### double maximum() const
    Devuelve el valor máximo permitido en el QDoubleSpinBox.

    Ejemplo:
    ```cpp
    double max = doubleSpinBox->maximum();
    ```
5. ### void setMaximum(double)
    Establece el valor máximo permitido en el QDoubleSpinBox.

    Parámetros:
    - double: El valor máximo.

    Ejemplo:
    ```cpp
    doubleSpinBox->setMaximum(100.0);
    ```
6. ### void setRange(double min, double max)
    Establece los valores mínimo y máximo permitidos en el QDoubleSpinBox.

    Parámetros:
    - min: El valor mínimo.
    - max: El valor máximo.

    Ejemplo:
    ```cpp
    doubleSpinBox->setRange(0.0, 100.0);
    ```
7. ### double value() const
    Devuelve el valor actual seleccionado en el QDoubleSpinBox.

    Ejemplo:
    ```cpp
    double currentValue = doubleSpinBox->value();
    ```
8. ### void setValue(double)
    Establece el valor actual del QDoubleSpinBox.

    Parámetros:
    - double: El valor a establecer.

    Ejemplo:
    ```cpp
    doubleSpinBox->setValue(50.5);
    ```
9. ### double singleStep() const
    Devuelve el tamaño del paso cuando se incrementa o decrementa el valor usando las flechas.

    Ejemplo:
    ```cpp
    double step = doubleSpinBox->singleStep();
    ```
10. ### void setSingleStep(double)
    Establece el tamaño del paso que el usuario da al incrementar o decrementar el valor.

    Parámetros:
    - double: El tamaño del paso.

    Ejemplo:
    ```cpp
    doubleSpinBox->setSingleStep(0.1);
    ```
11. ### int decimals() const
    Devuelve el número de decimales mostrados en el QDoubleSpinBox.

    Ejemplo:
    ```cpp
    int dec = doubleSpinBox->decimals();
    ```
12. ### void setDecimals(int)
    Establece el número de decimales mostrados en el QDoubleSpinBox.

    Parámetros:
    - int: El número de decimales.

    Ejemplo:
    ```cpp
    doubleSpinBox->setDecimals(2);
    ```
13. ### QString prefix() const
    Devuelve el prefijo actual del QDoubleSpinBox. Un prefijo es un texto que aparece antes del valor.

    Ejemplo:
    ```cpp
    QString currentPrefix = doubleSpinBox->prefix();
    ```
14. ### void setPrefix(const QString &prefix)
    Establece un prefijo para el valor del QDoubleSpinBox.

    Parámetros:
    - prefix: El prefijo a establecer.

    Ejemplo:
    ```cpp
    doubleSpinBox->setPrefix("$ ");
    ```
15. ### QString suffix() const
    Devuelve el sufijo actual del QDoubleSpinBox. Un sufijo es un texto que aparece después del valor.

    Ejemplo:
    ```cpp
    QString currentSuffix = doubleSpinBox->suffix();
    ```
16. ### void setSuffix(const QString &suffix)
    Establece un sufijo para el valor del QDoubleSpinBox.

    Parámetros:
    - suffix: El sufijo a establecer.

    Ejemplo:
    ```cpp
    doubleSpinBox->setSuffix(" kg");
    ```
17. ### void setWrapping(bool on)
    Activa o desactiva la funcionalidad de envoltura. Si está activado, al alcanzar el valor máximo se vuelve al mínimo y viceversa.

    Parámetros:
    - on: true para activar la envoltura, false para desactivarla.

    Ejemplo:
    ```cpp
    doubleSpinBox->setWrapping(true);
    ```
18. ### bool wrapping() const
    Devuelve si la envoltura está activada o no.
    Ejemplo:
    ```cpp
    bool isWrapping = doubleSpinBox->wrapping();
    ```
***
### Señales Principales
1. ### valueChanged(double)
    Esta señal se emite cuando el valor del QDoubleSpinBox cambia.

    Ejemplo:
    ```cpp
    connect(doubleSpinBox, &QDoubleSpinBox::valueChanged, this, [](double value) {
        qDebug() << "Valor actual:" << value;
    });
    ```
2. ### editingFinished()
    Esta señal se emite cuando el usuario termina de editar el valor manualmente y presiona "Enter" o cambia el foco.

    Ejemplo:
    ```cpp
    connect(doubleSpinBox, &QDoubleSpinBox::editingFinished, this, []() {
        qDebug() << "Edición finalizada";
    });
    ```
***
## Ejemplo Completo
Aquí tienes un ejemplo completo de cómo usar QDoubleSpinBox:
```cpp
#include <QApplication>
#include <QDoubleSpinBox>
#include <QVBoxLayout>
#include <QWidget>
#include <QLabel>

class DoubleSpinBoxExample : public QWidget {
public:
    DoubleSpinBoxExample(QWidget *parent = nullptr) : QWidget(parent) {
        QVBoxLayout *layout = new QVBoxLayout(this);

        QLabel *label = new QLabel("Valor del spinbox: 0.0", this);
        QDoubleSpinBox *doubleSpinBox = new QDoubleSpinBox(this);
        doubleSpinBox->setRange(0.0, 100.0);
        doubleSpinBox->setSingleStep(0.5);
        doubleSpinBox->setDecimals(2);
        doubleSpinBox->setPrefix("$ ");
        doubleSpinBox->setSuffix(" USD");

        layout->addWidget(label);
        layout->addWidget(doubleSpinBox);

        connect(doubleSpinBox, &QDoubleSpinBox::valueChanged, label, [label](double value) {
            label->setText("Valor del spinbox: " + QString::number(value));
        });
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    DoubleSpinBoxExample window;
    window.show();

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Selección de Precios
- Crea un QDoubleSpinBox para seleccionar el precio de un producto entre $0.00 y $500.00, con un paso de 0.25. Muestra el precio seleccionado en una etiqueta.
2.	### Precisión Decimal
- Implementa un QDoubleSpinBox donde el usuario pueda seleccionar el número de decimales que quiere mostrar (por ejemplo, de 0 a 4). Actualiza una etiqueta con el valor ajustado a la precisión seleccionada.
3.	### SpinBox con Envoltura
- Crea un QDoubleSpinBox con un rango de 0.0 a 10.0 y envoltura activada. Cuando el valor llegue a 10.0, debe volver a 0.0, y viceversa.
4.	### Selección de Peso
- Usa un QDoubleSpinBox para que el usuario seleccione su peso en kilogramos, con un rango de 30.0 a 150.0 kg y un paso de 0.1. Muestra el peso en una etiqueta.

