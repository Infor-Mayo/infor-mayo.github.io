---
layout: cabeza3
---

# Clase QJsonDocument
La clase QJsonDocument de Qt se utiliza para representar y manipular documentos JSON en C++. Un documento JSON puede ser un objeto JSON (clave-valor) o un arreglo JSON (una lista ordenada de valores). QJsonDocument facilita la conversión entre documentos JSON y las estructuras de datos de Qt, como QByteArray, y permite leer y escribir datos JSON fácilmente.
***
## Características Principales de QJsonDocument
- Representación de JSON: Un QJsonDocument puede contener tanto un objeto JSON (QJsonObject) como un arreglo JSON (QJsonArray).
- Facilidad de Conversión: Soporta la conversión desde y hacia cadenas de texto JSON (formato QByteArray) o formatos binarios para una manipulación más eficiente.
- Compatibilidad con las clases de JSON de Qt: Interactúa perfectamente con QJsonObject, QJsonArray, QJsonValue y QJsonParseError.
***
## Métodos Principales
1. ### Creación de un Documento JSON
    - QJsonDocument()

    Crea un documento JSON vacío.

    Ejemplo:
    ```cpp
    QJsonDocument doc;
    ```
    - QJsonDocument(const QJsonObject &object)

    Crea un documento JSON a partir de un objeto JSON.

    Ejemplo:
    ```cpp
    QJsonObject jsonObject;
    jsonObject["nombre"] = "Qt";
    jsonObject["version"] = 6;
    QJsonDocument doc(jsonObject);
    ```
    - QJsonDocument(const QJsonArray &array)

    Crea un documento JSON a partir de un arreglo JSON.

    Ejemplo:
    ```cpp
    QJsonArray jsonArray;
    jsonArray.append("Elemento 1");
    jsonArray.append("Elemento 2");
    QJsonDocument doc(jsonArray);
    ```
2. ### Convertir Documento JSON a Texto o Binario
    - toJson()

    Convierte el documento JSON en una cadena de texto (formato JSON) para ser enviada o almacenada.

    Ejemplo:
    ```cpp
    QJsonObject jsonObject;
    jsonObject["nombre"] = "Qt";
    QJsonDocument doc(jsonObject);
    QByteArray jsonBytes = doc.toJson();
    qDebug() << jsonBytes;  // Salida: {"nombre":"Qt"}
    ```
    - toBinaryData()

    Convierte el documento JSON en una representación binaria eficiente.

    Ejemplo:
    ```cpp
    QByteArray binaryData = doc.toBinaryData();
    ```
3. ### Convertir Texto o Binario a Documento JSON
    - fromJson(const QByteArray &json, QJsonParseError *error = nullptr)

    Convierte un texto en formato JSON a un QJsonDocument. Si hay un error durante la conversión, lo almacena en QJsonParseError.

    Ejemplo:
    ```cpp
    QByteArray jsonData = "{\"nombre\":\"Qt\", \"version\":6}";
    QJsonParseError error;
    QJsonDocument doc = QJsonDocument::fromJson(jsonData, &error);
    if (error.error != QJsonParseError::NoError) {
        qDebug() << "Error al parsear JSON:" << error.errorString();
    }
    ```
    - fromBinaryData(const QByteArray &data)

    Convierte datos binarios en un documento JSON.

    Ejemplo:
    ```cpp
    QByteArray binaryData = doc.toBinaryData();
    QJsonDocument newDoc = QJsonDocument::fromBinaryData(binaryData);
    ```
4. ### Acceso al Contenido del Documento
    - isObject()

    Retorna true si el documento contiene un objeto JSON.

    Ejemplo:
    ```cpp
    if (doc.isObject()) {
        QJsonObject obj = doc.object();
        qDebug() << obj["nombre"].toString();  // Salida: "Qt"
    }
    ```
    - isArray()

    Retorna true si el documento contiene un arreglo JSON.

    Ejemplo:
    ```cpp
    if (doc.isArray()) {
        QJsonArray array = doc.array();
        qDebug() << array[0].toString();  // Salida: "Elemento 1"
    }
    ```
    - object()

    Devuelve el objeto JSON si el documento contiene uno, de lo contrario retorna un objeto vacío.

    Ejemplo:
    ```cpp
    QJsonObject obj = doc.object();
    ```
    - array()

    Devuelve el arreglo JSON si el documento contiene uno, de lo contrario retorna un arreglo vacío.

    Ejemplo:
    ```cpp
    QJsonArray arr = doc.array();
    ```
***
## Ejemplo Completo
El siguiente ejemplo muestra cómo crear, leer y manipular documentos JSON usando QJsonDocument.
```cpp
#include <QCoreApplication>
#include <QJsonDocument>
#include <QJsonObject>
#include <QJsonArray>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    // Crear un objeto JSON
    QJsonObject jsonObject;
    jsonObject["nombre"] = "Qt";
    jsonObject["version"] = 6;

    // Crear un documento JSON
    QJsonDocument doc(jsonObject);

    // Convertir el documento a JSON en formato de texto
    QByteArray jsonData = doc.toJson();
    qDebug() << "JSON en formato de texto:" << jsonData;

    // Leer un documento JSON a partir de un texto
    QByteArray jsonInput = "{\"nombre\":\"Qt\", \"version\":6}";
    QJsonParseError error;
    QJsonDocument readDoc = QJsonDocument::fromJson(jsonInput, &error);
    if (error.error == QJsonParseError::NoError) {
        qDebug() << "Nombre:" << readDoc.object()["nombre"].toString();
        qDebug() << "Versión:" << readDoc.object()["version"].toInt();
    }

    return app.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Crear y manipular un documento JSON
- Crea un QJsonDocument que contenga un objeto JSON con propiedades como "nombre", "edad", y "ocupación". Modifica las propiedades y conviértelo a texto JSON.
2.	### Leer un JSON desde una cadena
- Escribe una función que tome una cadena JSON como entrada, la convierta a un QJsonDocument y luego acceda a varias propiedades del objeto o arreglo JSON.
3.	### Convertir entre JSON y binario
- Convierte un QJsonDocument a datos binarios y luego reconvierte esos datos binarios a un documento JSON, verificando que los datos sean correctos en ambas conversiones.
4.	### Trabajar con arreglos JSON
- Crea un QJsonArray que contenga una lista de objetos JSON. Usa un bucle para recorrer el arreglo y acceder a las propiedades de cada objeto.

