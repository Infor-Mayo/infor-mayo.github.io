---
layout: cabeza3
---

# Clase QComboBox
QComboBox ofrece una lista desplegable de opciones, y el usuario puede elegir una opción de la lista. También puede permitir la edición para que los usuarios escriban en él, además de elegir entre las opciones predefinidas.

***

## Funcionalidades clave de QComboBox
1. ### Constructores
    - QComboBox(QWidget *parent = nullptr): Crea un cuadro combinado vacío sin elementos.

    Ejemplo:
    ```cpp
    QComboBox *comboBox = new QComboBox(this);
    ```
2. ### Añadir elementos
    Puedes agregar elementos al QComboBox de diferentes formas, como mediante texto o con elementos asociados a datos.
    - addItem(const QString &text): Añade un solo elemento con solo texto.
    - addItems(const QStringList &items): Añade varios elementos a la vez.

    Ejemplo:
    ```cpp
    QComboBox *comboBox = new QComboBox(this);
    comboBox->addItem("Opción 1");
    comboBox->addItems({"Opción 2", "Opción 3", "Opción 4"});
    ```
3. ### Obtener y establecer el índice seleccionado
    El índice seleccionado es el elemento actualmente mostrado o elegido por el usuario.
    - currentIndex(): Devuelve el índice del elemento actualmente seleccionado.
    - setCurrentIndex(int index): Cambia el elemento seleccionado a través del índice.
    - currentText(): Devuelve el texto del elemento seleccionado actualmente.

    Ejemplo:
    ```cpp
    int index = comboBox->currentIndex();  // Obtener índice actual
    QString text = comboBox->currentText();  // Obtener texto del elemento actual
    ```
4. ### Conectar señales
    QComboBox emite varias señales que permiten reaccionar a la interacción del usuario.
    - currentIndexChanged(int index): Emitida cuando el índice cambia.
    - currentIndexChanged(const QString &text): Emitida cuando el texto del elemento seleccionado cambia.
    - activated(int index): Emitida cuando el usuario elige una opción del cuadro desplegable.

    Ejemplo:
    ```cpp
    connect(comboBox, QOverload<int>::of(&QComboBox::currentIndexChanged), this, [&](int index) {
        qDebug() << "Índice seleccionado:" << index;
    });
    ```
5. ### Habilitar edición
    QComboBox puede ser editable, permitiendo al usuario escribir en lugar de solo seleccionar elementos predefinidos.
    - setEditable(bool editable): Habilita o deshabilita la edición directa por parte del usuario.
    - isEditable(): Devuelve true si el cuadro combinado es editable.

    Ejemplo:
    ```cpp
    QComboBox *comboBox = new QComboBox(this);
    comboBox->setEditable(true);  // Habilitar edición
    ```
6. ### Eliminar elementos
    Puedes eliminar elementos individuales o limpiar todo el contenido de un QComboBox.
    - removeItem(int index): Elimina el elemento en la posición especificada.
    - clear(): Elimina todos los elementos del QComboBox.

    Ejemplo:
    ```cpp
    comboBox->removeItem(2);  // Elimina el tercer elemento
    comboBox->clear();  // Elimina todos los elementos
    ```
7. ### Manipular los datos de los elementos
    Cada elemento de un QComboBox puede tener datos adicionales asociados a él, además del texto que se muestra.
    - setItemData(int index, const QVariant &value): Asocia datos adicionales al elemento en la posición indicada.
    - itemData(int index): Obtiene los datos asociados a un elemento.

    Ejemplo:
    ```cpp
    comboBox->addItem("Opción 1", QVariant(100));  // Asocia el valor 100 a "Opción 1"
    QVariant data = comboBox->itemData(0);  // Obtiene los datos del primer elemento
    ```

***

## Ejemplos prácticos
1. ### Crear un QComboBox básico
```cpp
#include <QApplication>
#include <QComboBox>
#include <QVBoxLayout>
#include <QWidget>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QComboBox *comboBox = new QComboBox();
    comboBox->addItem("Opción 1");
    comboBox->addItems({"Opción 2", "Opción 3", "Opción 4"});

    layout.addWidget(comboBox);
    window.setLayout(&layout);

    window.show();
    return app.exec();
}
```
2. ### Manejar cambios en el índice seleccionado
```cpp
#include <QApplication>
#include <QComboBox>
#include <QVBoxLayout>
#include <QWidget>
#include <QDebug>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QComboBox *comboBox = new QComboBox();
    comboBox->addItems({"Opción A", "Opción B", "Opción C"});

    QObject::connect(comboBox, QOverload<int>::of(&QComboBox::currentIndexChanged), [&](int index) {
        qDebug() << "Nuevo índice seleccionado:" << index;
    });

    layout.addWidget(comboBox);
    window.setLayout(&layout);

    window.show();
    return app.exec();
}
```
3. ### Habilitar edición en un QComboBox
```cpp
#include <QApplication>
#include <QComboBox>
#include <QVBoxLayout>
#include <QWidget>
#include <QDebug>

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    QWidget window;
    QVBoxLayout layout;

    QComboBox *comboBox = new QComboBox();
    comboBox->setEditable(true);  // Habilitar edición
    comboBox->addItems({"Elemento 1", "Elemento 2", "Elemento 3"});

    QObject::connect(comboBox, QOverload<int>::of(&QComboBox::currentIndexChanged), [&](int index) {
        qDebug() << "Índice seleccionado:" << index;
    });

    layout.addWidget(comboBox);
    window.setLayout(&layout);

    window.show();
    return app.exec();
}
```

***

## Ejercicios de Consolidación
1.	Selector de país:
- Crea una aplicación que use un QComboBox para que el usuario seleccione un país de una lista. Muestra el país seleccionado en un QLabel cuando el usuario elige una opción.
2.	Formulario de preferencias:
- Diseña una interfaz donde el usuario pueda seleccionar varias configuraciones como "Idioma", "Formato de fecha" y "Zona horaria", cada una usando un QComboBox. Muestra las preferencias seleccionadas en una ventana de resumen.
3.	QComboBox editable:
- Crea un QComboBox editable que permita a los usuarios elegir o escribir su color favorito. Si el color escrito no está en la lista, agréguelo dinámicamente cuando el usuario presione Enter.
4.	Gestión de índices:
- Implementa una aplicación que contenga un QComboBox con varias opciones y un botón que elimine la opción seleccionada cuando se presiona. Usa removeItem() para gestionar la eliminación.
5.	Asociar datos a los elementos:
- Crea un QComboBox con una lista de productos. A cada producto asocia un precio como dato adicional. Al seleccionar un producto, muestra el precio en un QLabel.

***

Esto cubre las funcionalidades esenciales de QComboBox. 

