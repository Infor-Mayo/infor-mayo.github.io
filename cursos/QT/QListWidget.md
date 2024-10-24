---
layout: cabeza3
---

# Clase QListWidget
QListWidget proporciona una lista basada en elementos (items), donde cada elemento es un QListWidgetItem. Esta clase facilita la creación y gestión de listas simples, con la opción de interactuar con los elementos seleccionados.
***
## Funcionalidades clave de QListWidget
1. ### Crear y agregar elementos a la lista
    Para agregar elementos a un QListWidget, usamos la clase QListWidgetItem.
    - addItem(QListWidgetItem *item): Añade un elemento a la lista.
    - addItem(const QString &label): Crea y añade un elemento de texto.
    - addItems(const QStringList &labels): Añade varios elementos de texto a la lista.

    Ejemplo:
    ```cpp
    QListWidget *listWidget = new QListWidget(this);
    listWidget->addItem(new QListWidgetItem("Elemento 1"));
    listWidget->addItems({"Elemento 2", "Elemento 3", "Elemento 4"});
    ```
2. ### Obtener y modificar elementos
    Puedes acceder a los elementos de la lista para obtener información o modificarla.
    - item(int row): Devuelve el elemento en la fila dada.
    - row(QListWidgetItem *item): Devuelve el índice de fila para un elemento.
    - currentItem(): Devuelve el elemento actualmente seleccionado.
    - setCurrentItem(QListWidgetItem *item): Establece el elemento seleccionado.

    Ejemplo:
    ```cpp
    QListWidgetItem *item = listWidget->item(0);  // Obtiene el primer elemento
    item->setText("Nuevo texto para el primer elemento");
    ```
3. ### Eliminar elementos
    Puedes eliminar elementos específicos o todos los elementos de la lista.
    - takeItem(int row): Elimina y devuelve el elemento en la fila dada.
    - clear(): Elimina todos los elementos de la lista.

    Ejemplo:
    ```cpp
    listWidget->takeItem(2);  // Elimina el tercer elemento
    listWidget->clear();  // Limpia todos los elementos de la lista
    ```
4. ### Conectar señales
    QListWidget emite señales útiles cuando el usuario interactúa con la lista.
    - itemClicked(QListWidgetItem *item): Emitida cuando un elemento es clicado.
    - currentRowChanged(int row): Emitida cuando cambia el índice de la fila seleccionada.
    - itemDoubleClicked(QListWidgetItem *item): Emitida cuando un elemento es doble clicado.

    Ejemplo:
    ```cpp
    connect(listWidget, &QListWidget::itemClicked, this, [&](QListWidgetItem *item) {
        qDebug() << "Elemento clicado:" << item->text();
    });
    ```
5. ### Seleccionar y modificar elementos
    Puedes permitir la selección de uno o varios elementos en QListWidget.
    - setSelectionMode(QAbstractItemView::SelectionMode mode): Define cómo se seleccionan los elementos (por ejemplo, uno solo, múltiples, etc.).
    - QAbstractItemView::SingleSelection: Solo un elemento puede seleccionarse.
    - QAbstractItemView::MultiSelection: Se pueden seleccionar varios elementos.

    Ejemplo:
    ```cpp
    listWidget->setSelectionMode(QAbstractItemView::MultiSelection);  // Permitir selección múltiple
    ```
6. ### Personalizar elementos
    Puedes personalizar los elementos de la lista añadiendo iconos, modificando fuentes o colores, entre otros.
    - setIcon(const QIcon &icon): Establece un icono para el elemento.
    - setFont(const QFont &font): Cambia la fuente del texto del elemento.
    - setBackground(const QBrush &brush): Cambia el fondo del elemento.

    Ejemplo:
    ```cpp
    QListWidgetItem *item = new QListWidgetItem("Elemento con icono");
    item->setIcon(QIcon(":/resources/icon.png"));  // Establece un icono
    listWidget->addItem(item);
    ```
***
## Ejemplos prácticos
1. ### Crear una lista de elementos básicos
```cpp
#include <QApplication>
#include <QListWidget>
#include <QVBoxLayout>
#include <QWidget>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QListWidget *listWidget = new QListWidget();
    listWidget->addItems({"Elemento 1", "Elemento 2", "Elemento 3"});

    layout.addWidget(listWidget);
    window.setLayout(&layout);

    window.show();
    return app.exec();
}
```
2. ### Gestionar la selección de elementos
```cpp
#include <QApplication>
#include <QListWidget>
#include <QVBoxLayout>
#include <QWidget>
#include <QDebug>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QListWidget *listWidget = new QListWidget();
    listWidget->addItems({"Opción 1", "Opción 2", "Opción 3"});

    QObject::connect(listWidget, &QListWidget::itemClicked, [&](QListWidgetItem *item) {
        qDebug() << "Elemento seleccionado:" << item->text();
    });

    layout.addWidget(listWidget);
    window.setLayout(&layout);

    window.show();
    return app.exec();
}
```
3. ### Personalizar elementos en la lista
```cpp
#include <QApplication>
#include <QListWidget>
#include <QVBoxLayout>
#include <QWidget>
#include <QIcon>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QListWidget *listWidget = new QListWidget();
    QListWidgetItem *item = new QListWidgetItem("Elemento con icono");
    item->setIcon(QIcon(":/resources/icon.png"));
    listWidget->addItem(item);

    layout.addWidget(listWidget);
    window.setLayout(&layout);

    window.show();
    return app.exec();
}
```
4. ### Selección múltiple
```cpp
#include <QApplication>
#include <QListWidget>
#include <QVBoxLayout>
#include <QWidget>
#include <QDebug>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QListWidget *listWidget = new QListWidget();
    listWidget->addItems({"Opción 1", "Opción 2", "Opción 3", "Opción 4"});
    listWidget->setSelectionMode(QAbstractItemView::MultiSelection);

    QObject::connect(listWidget, &QListWidget::itemClicked, [&](QListWidgetItem *item) {
        qDebug() << "Elemento seleccionado:" << item->text();
    });

    layout.addWidget(listWidget);
    window.setLayout(&layout);

    window.show();
    return app.exec();
}
```
***
## Ejercicios de Consolidación
1. ###	Lista de tareas pendientes:
- Crea una aplicación que permita agregar y eliminar tareas en un QListWidget. Incluye un botón que elimine la tarea seleccionada de la lista.
2. ###	Seleccionar múltiples opciones:
- Diseña una aplicación que muestre una lista de opciones en un QListWidget con selección múltiple. Al hacer clic en un botón, se debe mostrar en un QLabel todas las opciones seleccionadas.
3. ###	Lista de compras con iconos:
- Implementa una lista de compras donde cada elemento de la lista tenga un icono representando el producto. Usa QListWidgetItem para personalizar los elementos.
4. ###	Editor de elementos:
- Crea una aplicación que permita al usuario seleccionar un elemento de un QListWidget y cambiar su texto en un QLineEdit. Al presionar un botón, el texto del elemento seleccionado debe actualizarse.
5. ###	Gestión de selecciones:
- Diseña una aplicación que tenga una lista de opciones, un botón para seleccionar todas las opciones, y otro botón para deseleccionarlas todas. Usa QListWidget y QAbstractItemView::MultiSelection.
***
Esto cubre las funcionalidades esenciales de QListWidget.
