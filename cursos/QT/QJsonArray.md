---
layout: cabeza3
---

# Clase QJsonArray
La clase QJsonArray en Qt representa una lista de valores JSON. Cada valor almacenado en un QJsonArray es de tipo QJsonValue, lo que permite tener diferentes tipos de datos (cadenas, números, objetos, arreglos, etc.) dentro del mismo arreglo.
***
## Características Principales de QJsonArray
- Almacena una lista ordenada de valores: Cada valor en el arreglo puede ser de cualquier tipo JSON válido (booleanos, cadenas, números, objetos, etc.).
- Manipulación dinámica: Permite agregar, eliminar y modificar valores en el arreglo fácilmente.
- Compatibilidad con otras clases JSON de Qt: Utilizado comúnmente junto con QJsonObject y QJsonDocument para representar y manejar estructuras JSON complejas.
***
## Métodos Principales
1. ### Creación de un Arreglo JSON
    - QJsonArray()

    Constructor que crea un arreglo JSON vacío.

    Ejemplo:
    ```cpp
    QJsonArray jsonArray;
    ```
2. ### Agregar Elementos al Arreglo
    - append(const QJsonValue &value)

    Agrega un valor al final del arreglo JSON.

    Ejemplo:
    ```cpp
    QJsonArray jsonArray;
    jsonArray.append("Elemento 1");
    jsonArray.append(42);
    jsonArray.append(true);
    ```
3. ### Acceder a Elementos
    - at(int index) const

    Devuelve el valor en el índice especificado.

    Ejemplo:
    ```cpp
    QJsonValue value = jsonArray.at(1);  // Accede al segundo elemento
    qDebug() << value.toInt();  // Salida: 42
    ```
    - Operador []

    Otra forma de acceder a los elementos usando el índice.

    Ejemplo:
    ```cpp
    QJsonValue value = jsonArray[0];  // Accede al primer elemento
    qDebug() << value.toString();  // Salida: "Elemento 1"
    ```
4. ### Modificar Elementos
    - replace(int index, const QJsonValue &value)

    Reemplaza el valor en el índice especificado con un nuevo valor.

    Ejemplo:
    ```cpp
    jsonArray.replace(1, 100);  // Reemplaza el segundo elemento con 100
    ```
5. ### Eliminar Elementos
    - removeAt(int index)

    Elimina el elemento en el índice especificado.

    Ejemplo:
    ```cpp
    jsonArray.removeAt(2);  // Elimina el tercer elemento
    ```
6. ### Verificación y Tamaño del Arreglo
    - size() const

    Retorna el número de elementos en el arreglo.

    Ejemplo:
    ```cpp
    int size = jsonArray.size();  // Número de elementos en el arreglo
    ```
    - isEmpty() const

    Retorna true si el arreglo está vacío.

    Ejemplo:
    ```cpp
    if (jsonArray.isEmpty()) {
        qDebug() << "El arreglo está vacío.";
    }
    ```
7. ### Iterar Sobre los Elementos
    - begin() const y end() const

    Permite iterar sobre los elementos del arreglo.

    Ejemplo:
    ```cpp
    for (QJsonValue value : jsonArray) {
        qDebug() << value;
    }
    ```
8. ### Convertir a Otros Tipos
    - toVariantList() const

    Convierte el arreglo JSON a una lista de variantes (QVariantList).

    Ejemplo:
    ```cpp
    QVariantList variantList = jsonArray.toVariantList();
    ```
***
## Ejemplo Completo
Este ejemplo muestra cómo crear un QJsonArray, agregar varios tipos de datos, acceder a ellos, y convertir el arreglo en un documento JSON.
```cpp
#include <QCoreApplication>
#include <QJsonArray>
#include <QJsonDocument>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    // Crear un arreglo JSON
    QJsonArray jsonArray;
    jsonArray.append("Qt");
    jsonArray.append(42);
    jsonArray.append(true);

    // Acceder a los elementos
    qDebug() << "Primer elemento:" << jsonArray[0].toString();
    qDebug() << "Segundo elemento:" << jsonArray[1].toInt();
    qDebug() << "Tercer elemento:" << jsonArray[2].toBool();

    // Reemplazar un valor
    jsonArray.replace(1, 100);

    // Eliminar el último elemento
    jsonArray.removeAt(2);

    // Convertir el arreglo JSON en un documento JSON
    QJsonDocument jsonDoc(jsonArray);
    QByteArray jsonData = jsonDoc.toJson();
    qDebug() << "Arreglo JSON en texto:" << jsonData;

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Crear y manipular un QJsonArray
- Crea un arreglo JSON que contenga una lista de nombres de frutas. Agrega cinco frutas, accede a cada una y luego elimina la tercera.
2.	### Mezclar tipos de datos en un QJsonArray
- Crea un QJsonArray que contenga una mezcla de tipos de datos: una cadena, un número y un objeto JSON. Accede y muestra cada elemento.
3.	### Convertir entre QJsonArray y QVariantList
- Crea un arreglo JSON que contenga tres números. Convierte este arreglo a una QVariantList y accede a los valores usando la lista de variantes.
4.	### Iterar y modificar un QJsonArray
- Crea un arreglo JSON que contenga una lista de tareas (cada tarea es una cadena). Itera sobre el arreglo y marca cada tarea como completada (modificar el valor) agregando " - completada" al final de cada tarea.
***
Con esto, has cubierto la clase QJsonArray y sus principales funcionalidades, junto con ejemplos y ejercicios que te ayudarán a consolidar lo aprendido.

