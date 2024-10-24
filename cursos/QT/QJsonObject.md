---
layout: cabeza3
---

# Clase QJsonObject
La clase QJsonObject de Qt es una representación de un objeto JSON, que es una colección de pares clave-valor. Es un contenedor que permite almacenar valores de tipo QJsonValue y asociarlos a claves de tipo QString. Es equivalente a lo que se conoce como un objeto en JSON, y se utiliza para representar estructuras de datos más complejas en JSON.
***
## Características Principales de QJsonObject
- Almacena datos en pares clave-valor: Cada clave es una cadena (QString), y cada valor es un QJsonValue.
- Compatibilidad con otras clases JSON de Qt: Se puede usar junto con QJsonDocument, QJsonArray, y QJsonValue para formar documentos JSON más complejos.
- Fácil manipulación: Métodos sencillos para agregar, eliminar, modificar y consultar pares clave-valor.
***
## Métodos Principales
1. ### Creación de un Objeto JSON
    - QJsonObject()

    Constructor que crea un objeto JSON vacío.

    Ejemplo:
    ```cpp
    QJsonObject jsonObject;
    ```
2. ### Agregar o Modificar Pares Clave-Valor
    - insert(const QString &key, const QJsonValue &value)

    Inserta o modifica un valor en el objeto JSON asociado a una clave específica.
    
    Ejemplo:
    ```cpp
    QJsonObject jsonObject;
    jsonObject.insert("nombre", "Qt");
    jsonObject.insert("version", 6);
    ```
    - Operador []

    También se puede utilizar para insertar o modificar valores usando la sintaxis de índice.

    Ejemplo:
    ```cpp
    QJsonObject jsonObject;
    jsonObject["nombre"] = "Qt";
    jsonObject["version"] = 6;
    ```
3. ### Acceso a los Valores
    - value(const QString &key) const

    Devuelve el valor asociado a una clave específica.

    Ejemplo:
    ```cpp
    QJsonObject jsonObject;
    jsonObject["nombre"] = "Qt";
    qDebug() << jsonObject.value("nombre").toString();  // Salida: "Qt"
    ```
    - Operador [] (const)

    Devuelve el valor asociado a una clave, similar al método value.

    Ejemplo:
    ```cpp
    qDebug() << jsonObject["version"].toInt();  // Salida: 6
    ```
4. ### Verificación de Existencia de Claves
    - contains(const QString &key) const

    Retorna true si el objeto contiene una clave específica.

    Ejemplo:
    ```cpp
    if (jsonObject.contains("nombre")) {
        qDebug() << "Clave 'nombre' encontrada.";
    }
    ```
5. ### Eliminación de Claves
    - remove(const QString &key)

    Elimina un par clave-valor del objeto JSON.

    Ejemplo:
    ```cpp
    jsonObject.remove("version");
    ```
6. ### Iteración a Través del Objeto
    - keys() const

    Devuelve una lista de todas las claves presentes en el objeto JSON.

    Ejemplo:
    ```cpp
    QStringList keys = jsonObject.keys();
    for (const QString &key : keys) {
        qDebug() << key;
    }
    ```
    - size() const

    Retorna el número de pares clave-valor en el objeto JSON.

    Ejemplo:
    ```cpp
    int size = jsonObject.size();  // Número de claves en el objeto
    ```
7. ### Convertir a Otros Tipos
    - toVariantMap() const

    Convierte el objeto JSON a un QVariantMap, que es un mapa de pares clave-valor en Qt.

    Ejemplo:
    ```cpp
    QVariantMap variantMap = jsonObject.toVariantMap();
    ```
    - isEmpty() const

    Retorna true si el objeto JSON está vacío.

    Ejemplo:
    ```cpp
    if (jsonObject.isEmpty()) {
        qDebug() << "El objeto JSON está vacío.";
    }
    ```
***
## Ejemplo Completo
El siguiente ejemplo muestra cómo crear un QJsonObject, agregar datos, acceder a ellos y convertir el objeto JSON en un QJsonDocument para su posterior uso.
```cpp
#include <QCoreApplication>
#include <QJsonObject>
#include <QJsonDocument>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    // Crear un objeto JSON
    QJsonObject jsonObject;
    jsonObject["nombre"] = "Qt";
    jsonObject["version"] = 6;

    // Verificar si contiene una clave
    if (jsonObject.contains("nombre")) {
        qDebug() << "Nombre:" << jsonObject["nombre"].toString();
    }

    // Convertir el objeto JSON a un documento JSON
    QJsonDocument jsonDoc(jsonObject);
    QByteArray jsonData = jsonDoc.toJson();
    qDebug() << "Documento JSON en texto:" << jsonData;

    // Eliminar una clave
    jsonObject.remove("version");
    qDebug() << "Después de eliminar 'version':" << jsonObject;

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Crear y manipular un QJsonObject
- Crea un objeto JSON que represente a una persona con las claves "nombre", "edad", y "ocupación". Agrega algunos datos, accede a ellos y elimina la clave "ocupación".
2.	### Convertir un QJsonObject a QVariantMap
- Crea un QJsonObject que contenga datos como un libro (título, autor, precio). Convierte el objeto JSON a un QVariantMap y utiliza este mapa para acceder a los valores.
3.	### Uso de múltiples tipos de datos en un objeto JSON
- Crea un objeto JSON que contenga un arreglo de objetos, donde cada objeto represente una tarea con las claves "descripción" y "completado" (un booleano). Recorre los elementos para verificar el estado de cada tarea.
4.	### Leer un JSON desde un archivo y modificar el objeto
- Crea un archivo de texto con contenido JSON que contenga información sobre un coche (marca, modelo, año). Lée el archivo, convierte el contenido a un QJsonObject, modifica la información y luego guárdalo nuevamente en el archivo.

