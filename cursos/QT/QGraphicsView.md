---
layout: cabeza3
---

# Clase QGraphicsView
La clase QGraphicsView es una vista para mostrar y gestionar escenas en el framework gráfico de Qt. QGraphicsView proporciona una interfaz para visualizar el contenido de una QGraphicsScene, lo que permite representar gráficos en 2D, gestionar transformaciones, manipular objetos y capturar eventos como clics o desplazamientos.

Se utiliza junto con QGraphicsScene y QGraphicsItem para construir gráficos interactivos complejos y sistemas de visualización en 2D.
***
## Características Principales
- Permite visualizar y manipular una escena que contiene gráficos en 2D.
- Soporte para escalado, rotación y transformación de la vista.
- Gestión de eventos de interacción con los gráficos como eventos de ratón o teclado.
- Scroll automático para visualizar áreas de la escena que no caben en la ventana.
***
## Métodos principales de QGraphicsView
1. ### QGraphicsView(QGraphicsScene *scene, QWidget *parent = nullptr)
    Constructor que inicializa una vista para la escena gráfica dada.
    
    Parámetros:
    - scene: La escena gráfica que se visualizará.
    - parent: El widget padre (opcional).
    
    Ejemplo:
    ```cpp
    QGraphicsScene *scene = new QGraphicsScene();
    QGraphicsView *view = new QGraphicsView(scene);
    ```
2. ### void setScene(QGraphicsScene *scene)
    Establece la escena gráfica que se visualizará en la vista.
    
    Parámetros:
    - scene: La escena gráfica.
    
    Ejemplo:
    ```cpp
    QGraphicsScene *scene = new QGraphicsScene();
    view->setScene(scene);
    ```
3. ### void setRenderHint(QPainter::RenderHint hint, bool enabled = true)
    Establece una pista de renderizado para mejorar la calidad o el rendimiento de los gráficos.
    
    Parámetros:
    - hint: La pista de renderizado (como QPainter::Antialiasing para suavizar los bordes).
    - enabled: Booleano que indica si se debe habilitar o deshabilitar la pista.
    
    Ejemplo:
    ```cpp
    view->setRenderHint(QPainter::Antialiasing);
    ```
4. ### void setTransformationAnchor(Anchor anchor)
    Establece el ancla para las transformaciones (zoom, rotación). Puede ser en el centro de la vista o en el ratón.
    
    Parámetros:
    - anchor: El tipo de ancla (QGraphicsView::AnchorUnderMouse, QGraphicsView::AnchorViewCenter).
    
    Ejemplo:
    ```cpp
    view->setTransformationAnchor(QGraphicsView::AnchorUnderMouse);
    ```
5. ### void setDragMode(DragMode mode)
    Establece el modo de arrastre para mover elementos o la propia escena.
    
    Parámetros:
    - mode: El modo de arrastre (QGraphicsView::NoDrag, QGraphicsView::ScrollHandDrag, QGraphicsView::RubberBandDrag).
    
    Ejemplo:
    ```cpp
    view->setDragMode(QGraphicsView::ScrollHandDrag);  // Arrastra la vista completa
    ```
6. ### void scale(qreal sx, qreal sy)
    Escala la vista por un factor en los ejes X e Y.
   
    Parámetros:
    - sx: Factor de escala en el eje X.
    - sy: Factor de escala en el eje Y.
    
    Ejemplo:
    ```cpp
    view->scale(1.5, 1.5);  // Escala la vista al 150%
    ```
7. ### void rotate(qreal angle)
    Rota la vista por un ángulo dado en grados.
    
    Parámetros:
    - angle: El ángulo de rotación en grados.
    
    Ejemplo:
    ```cpp
    view->rotate(45);  // Rotar la vista 45 grados
    ```
8. ### void fitInView(const QRectF &rect, Qt::AspectRatioMode mode = Qt::IgnoreAspectRatio)
    Ajusta la vista para que encaje dentro de un área específica, manteniendo o ignorando la relación de aspecto.
    
    Parámetros:
    - rect: El área que se debe ajustar en la vista.
    - mode: Modo de relación de aspecto (por ejemplo, Qt::KeepAspectRatio o Qt::IgnoreAspectRatio).
    
    Ejemplo:
    ```cpp
    QRectF sceneRect(0, 0, 200, 200);
    view->fitInView(sceneRect, Qt::KeepAspectRatio);  // Ajustar la vista para encajar en un área
    ```
9. ### void centerOn(const QPointF &pos)
    Centra la vista en una posición específica de la escena.
    
    Parámetros:
    - pos: La posición en la escena donde se centrará la vista.
    
    Ejemplo:
    ```cpp
    view->centerOn(QPointF(100, 100));  // Centrar la vista en el punto (100, 100)
    ```
10. ### void setViewportUpdateMode(ViewportUpdateMode mode)
    Establece el modo de actualización de la ventana gráfica, controlando cómo y cuándo se actualiza la vista.
    
    Parámetros:
    - mode: El modo de actualización (por ejemplo, QGraphicsView::FullViewportUpdate, QGraphicsView::MinimalViewportUpdate).
    
    Ejemplo:
    ```cpp
    view->setViewportUpdateMode(QGraphicsView::MinimalViewportUpdate);  // Actualización mínima para mejorar rendimiento
    ```
***
## Ejemplo Completo
```cpp
#include <QApplication>
#include <QGraphicsView>
#include <QGraphicsScene>
#include <QGraphicsRectItem>

int main(int argc, char *argv[]) {
    QApplication a(argc, argv);

    // Crear la escena
    QGraphicsScene *scene = new QGraphicsScene();

    // Añadir un rectángulo a la escena
    QGraphicsRectItem *rect = scene->addRect(0, 0, 100, 100);

    // Crear la vista y establecer la escena
    QGraphicsView *view = new QGraphicsView(scene);

    // Ajustes de la vista
    view->setRenderHint(QPainter::Antialiasing);
    view->setDragMode(QGraphicsView::ScrollHandDrag);
    view->scale(1.5, 1.5);  // Escalar al 150%
    view->rotate(45);  // Rotar 45 grados

    view->show();

    return a.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Transformaciones Básicas
- Crea una aplicación que muestre una QGraphicsScene con varios elementos gráficos como rectángulos y círculos. Implementa botones para realizar escalado, rotación y desplazamiento de la vista.
2.	### Arrastrar y Soltar Elementos
- Implementa una aplicación que permita arrastrar elementos dentro de la QGraphicsScene usando QGraphicsView::RubberBandDrag.
3.	### Ajuste de Vista
- Crea una escena con varios objetos de diferentes tamaños y posiciones. Implementa botones para centrar la vista en objetos específicos y ajustar la vista para que todos los elementos se vean.
4.	### Aplicación Completa con Interacción
- Crea una aplicación con una QGraphicsView que permita al usuario agregar, eliminar y manipular elementos gráficos en la escena. Implementa opciones para cambiar el modo de arrastre, ajustar la vista y aplicar transformaciones como rotación y escalado.
***
Estos ejercicios ayudarán a consolidar el uso de QGraphicsView y su integración en aplicaciones gráficas interactivas con Qt.

