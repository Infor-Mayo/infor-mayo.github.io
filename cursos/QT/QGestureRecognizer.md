---
layout: cabeza3
---

# Clase QGestureRecognizer
La clase QGestureRecognizer en Qt permite crear y manejar gestos personalizados en aplicaciones gráficas. Los gestos son interacciones que los usuarios realizan con la pantalla táctil, el ratón u otros dispositivos de entrada, y pueden ser simples (como un clic o arrastrar) o más complejos (como pellizcar para hacer zoom o deslizar).

Qt ya ofrece algunos gestos predefinidos como los gestos de deslizamiento (QSwipeGesture), el gesto de pellizco (QPinchGesture) y el gesto de rotación (QRotationGesture), pero si se necesita un gesto personalizado, QGestureRecognizer permite definirlo.
***
## Características Principales de QGestureRecognizer
- Reconocimiento de Gestos Personalizados: Permite definir nuevos gestos y su comportamiento.
- Integración con Eventos de Entrada: QGestureRecognizer maneja eventos de entrada (como toques o clics) para detectar cuando un gesto ha comenzado, está en progreso o ha terminado.
- Soporte Multidispositivo: Se puede usar con pantallas táctiles, ratones, lápices o cualquier dispositivo de entrada.
***
## Métodos Principales de QGestureRecognizer
1. ### create()
    Este método crea una instancia del gesto que se va a manejar.
    ```cpp
    QGesture *create(QObject *target);
    ```
    - target: El objeto donde se desea aplicar el gesto.

    Ejemplo:
    ```cpp
    QGesture *gesture = myGestureRecognizer->create(myWidget);
    ```
2. ### reset()
    Reinicia el estado del reconocimiento de gestos. Esto se utiliza cuando un gesto se cancela o se completa, para prepararlo para la siguiente interacción.
    ```cpp
    void reset(QGesture *gesture);
    ```
    Ejemplo:
    ```cpp
    myGestureRecognizer->reset(myGesture);
    ```
3. ### recognize()
    El método más importante de la clase. Este método es el encargado de reconocer el gesto basado en los eventos de entrada.
    ```cpp
    QGestureRecognizer::Result recognize(QGesture *gesture, QObject *watched, QEvent *event);
    ```
    - gesture: El gesto que se está intentando reconocer.
    - watched: El objeto sobre el que se está observando el gesto.
    - event: El evento de entrada (como un toque o movimiento del ratón) que se usa para reconocer el gesto.

    El valor de retorno indica si el gesto ha sido reconocido, está en progreso o ha terminado.

    Ejemplo:
    ```cpp
    QGestureRecognizer::Result result = myGestureRecognizer->recognize(myGesture, myWidget, myEvent);
    ```
4. ### registerRecognizer()
    Registra el reconocimiento de un gesto en el sistema de gestos de Qt. Esto permite que tu aplicación reconozca gestos personalizados.
    ```cpp
    Qt::GestureType QGestureRecognizer::registerRecognizer(QGestureRecognizer *recognizer);
    ```
    Ejemplo:
    ```cpp
    Qt::GestureType customGestureType = QGestureRecognizer::registerRecognizer(myGestureRecognizer);
    ```
5. ### unregisterRecognizer()
    Elimina el reconocimiento de un gesto personalizado del sistema de gestos de Qt.
    ```cpp
    void unregisterRecognizer(Qt::GestureType type);
    ```
    Ejemplo:
    ```cpp
    QGestureRecognizer::unregisterRecognizer(customGestureType);
    ```
6. ### cleanup()
    Este método se utiliza para limpiar los datos del gesto y liberar recursos asociados. Generalmente se llama cuando se elimina el objeto que maneja el gesto.
    ```cpp
    void cleanup(QGesture *gesture);
    ```
***
## Crear un Gesto Personalizado
Para definir un gesto personalizado, necesitas crear una subclase de QGestureRecognizer y sobrecargar los métodos create(), reset(), y recognize().

Ejemplo: Gesto Personalizado de "Doble Toque"
A continuación se muestra un ejemplo de cómo implementar un gesto de "doble toque" personalizado.
```cpp
#include <QGestureRecognizer>
#include <QGesture>
#include <QMouseEvent>
#include <QDebug>

class DoubleTapGesture : public QGesture {
public:
    DoubleTapGesture(QObject *parent = nullptr) : QGesture(parent) {}
};

class DoubleTapGestureRecognizer : public QGestureRecognizer {
public:
    QGesture *create(QObject *target) override {
        return new DoubleTapGesture(target);
    }

    QGestureRecognizer::Result recognize(QGesture *gesture, QObject *watched, QEvent *event) override {
        if (event->type() == QEvent::MouseButtonDblClick) {
            qDebug() << "Gesto de doble toque detectado";
            return QGestureRecognizer::FinishGesture;
        }
        return QGestureRecognizer::Ignore;
    }

    void reset(QGesture *gesture) override {
        QGestureRecognizer::reset(gesture);
    }
};
```
En este ejemplo:
- DoubleTapGesture define un nuevo tipo de gesto.
- DoubleTapGestureRecognizer sobrecarga el método recognize() para manejar un evento de doble clic del ratón como un gesto de "doble toque".

Para registrar y usar este gesto, puedes hacer lo siguiente:
```cpp
DoubleTapGestureRecognizer *recognizer = new DoubleTapGestureRecognizer;
Qt::GestureType doubleTapGestureType = QGestureRecognizer::registerRecognizer(recognizer);
myWidget->grabGesture(doubleTapGestureType);
```
***
## Ejercicios de Consolidación
1.	### Crear un Gesto de Deslizar Personalizado
- Implementa un gesto personalizado que detecte un deslizamiento horizontal o vertical y dibuje una línea que siga la trayectoria del movimiento.
2.	### Gesto de Rotación Personalizado
- Crea un gesto personalizado que detecte cuando el usuario realiza un gesto de rotación con dos dedos, similar al gesto de rotación que ya existe en Qt.
3.	### Gesto de Toque Prolongado
- Implementa un gesto personalizado que detecte cuando el usuario mantiene un toque en la pantalla durante un cierto período de tiempo (gesto de "toque prolongado").
4.	### Aplicación con Múltiples Gestos
- Desarrolla una aplicación que maneje varios gestos personalizados (por ejemplo, deslizar, rotar y doble toque), y realiza diferentes acciones en la interfaz gráfica dependiendo del gesto detectado.
***
QGestureRecognizer te permite llevar la interacción del usuario a otro nivel, permitiendo que tu aplicación sea más intuitiva al soportar gestos naturales o personalizados. Esto es especialmente útil en dispositivos con pantalla táctil, donde los gestos pueden mejorar enormemente la experiencia del usuario.


