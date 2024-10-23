---
layout: cabeza3
---

# Clase QDomDocument
QDomDocument es una clase de Qt que proporciona una implementación completa del Modelo de Objetos de Documento (DOM) para manejar documentos XML. Permite cargar, modificar y guardar documentos XML de forma estructurada, ofreciendo una interfaz familiar para aquellos que han trabajado con DOM en otros lenguajes o entornos.
Esta clase es esencial cuando se trabaja con datos estructurados en formato XML, ya que permite navegar y manipular el árbol de nodos XML de manera eficiente.
***
## Características Principales de QDomDocument
- Carga y Almacenamiento de XML: Permite cargar documentos XML desde cadenas o archivos y guardarlos nuevamente después de modificarlos.
- Manipulación de Nodos: Proporciona métodos para crear, acceder y modificar elementos, atributos, texto y otros tipos de nodos.
- Navegación del Árbol DOM: Facilita la navegación por el árbol de nodos, permitiendo recorrer los hijos, hermanos y padres de cada nodo.
- Compatibilidad con DOM Nivel 2: Implementa la mayoría de las características del estándar DOM Nivel 2.
***
## Métodos Principales de QDomDocument
1. ### Constructores
    - QDomDocument()

    Crea un documento DOM vacío.

    ```cpp
    QDomDocument doc;
    ```
    - QDomDocument(const QString &name)

    Crea un documento DOM con un nombre específico (usualmente el nombre de la raíz).

    ```cpp
    QDomDocument doc("MiDocumento");
    ```
2. ### Carga de Documentos XML
    - bool setContent(const QString &text, bool *ok = nullptr, QString *errorMsg = nullptr, int *errorLine = nullptr, int *errorColumn = nullptr)

    Carga el contenido XML desde una cadena de texto.
    ```cpp
    QString xmlData = "<root><element>Valor</element></root>";
    bool ok;
    QString errorMsg;
    int errorLine, errorColumn;

    if (!doc.setContent(xmlData, &ok, &errorMsg, &errorLine, &errorColumn)) {
        qDebug() << "Error al cargar XML:" << errorMsg << "en línea" << errorLine << "columna" << errorColumn;
    }
    ```
    - bool setContent(QIODevice *device, bool *ok = nullptr, QString *errorMsg = nullptr, int *errorLine = nullptr, int *errorColumn = nullptr)

    Carga el contenido XML desde un dispositivo de entrada/salida, como un archivo.
    ```cpp
    QFile file("miarchivo.xml");
    if (!file.open(QIODevice::ReadOnly)) {
        qDebug() << "No se pudo abrir el archivo";
        return;
    }
    if (!doc.setContent(&file, &ok, &errorMsg, &errorLine, &errorColumn)) {
        qDebug() << "Error al cargar XML:" << errorMsg << "en línea" << errorLine << "columna" << errorColumn;
    }
    ```
3. ### Acceso a Elementos del Documento
    - QDomElement documentElement() const

    Devuelve el elemento raíz del documento.
    ```cpp
    QDomElement root = doc.documentElement();
    ```
    - QDomNodeList elementsByTagName(const QString &tagname) const

    Devuelve una lista de nodos que tienen un nombre de etiqueta específico.
    ```cpp
    QDomNodeList items = doc.elementsByTagName("item");
    ```
4. ### Creación de Nuevos Nodos
    - QDomElement createElement(const QString &tagName)

    Crea un nuevo elemento con el nombre de etiqueta especificado.
    ```cpp
    QDomElement newElement = doc.createElement("producto");
    ```
    - QDomText createTextNode(const QString &data)

    Crea un nuevo nodo de texto con el contenido especificado.
    ```cpp
    QDomText textNode = doc.createTextNode("Este es un texto");
    ```
5. ### Modificación del Árbol DOM
    - void appendChild(const QDomNode &newChild)

    Añade un nuevo hijo al nodo actual.
    ```cpp
    root.appendChild(newElement);
    ```
    - void setAttribute(const QString &name, const QString &value)

    Establece un atributo para un elemento.
    ```cpp
    newElement.setAttribute("id", "123");
    ```
    - QDomNode replaceChild(const QDomNode &newChild, const QDomNode &oldChild)

    Reemplaza un hijo existente con un nuevo nodo.
    ```cpp
    root.replaceChild(newElement, oldElement);
    ```
    - QDomNode removeChild(const QDomNode &oldChild)

    Elimina un hijo del nodo actual.
    ```cpp
    root.removeChild(childNode);
    ```
6. ### Serialización del Documento
    - QString toString(int indent = 1) const

    Convierte el documento en una cadena XML. El parámetro indent especifica el nivel de indentación.
    ```cpp
    QString xmlOutput = doc.toString(4);
    qDebug() << xmlOutput;
    ```
    - bool save(QTextStream &stream, int indent = 1, QDomNode::EncodingPolicy encodingPolicy = QDomNode::EncodingFromDocument) const

    Guarda el documento en un flujo de texto.
    ```cpp
    QFile file("output.xml");
    if (!file.open(QIODevice::WriteOnly)) {
        qDebug() << "No se pudo abrir el archivo para escribir";
        return;
    }
    QTextStream out(&file);
    doc.save(out, 4);
    ```
***
## Ejemplo Completo
En este ejemplo, cargaremos un documento XML desde una cadena, modificaremos su contenido y luego lo guardaremos en un archivo.
```cpp
#include <QCoreApplication>
#include <QDomDocument>
#include <QFile>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    QString xmlData = R"(
        <productos>
            <producto id="1">
                <nombre>Producto A</nombre>
                <precio>10.0</precio>
            </producto>
            <producto id="2">
                <nombre>Producto B</nombre>
                <precio>15.0</precio>
            </producto>
        </productos>
    )";

    QDomDocument doc;
    QString errorMsg;
    int errorLine, errorColumn;

    if (!doc.setContent(xmlData, &errorMsg, &errorLine, &errorColumn)) {
        qDebug() << "Error al cargar XML:" << errorMsg << "en línea" << errorLine << "columna" << errorColumn;
        return -1;
    }

    // Acceder al elemento raíz
    QDomElement root = doc.documentElement();

    // Crear un nuevo elemento
    QDomElement newProduct = doc.createElement("producto");
    newProduct.setAttribute("id", "3");

    QDomElement name = doc.createElement("nombre");
    QDomText nameText = doc.createTextNode("Producto C");
    name.appendChild(nameText);

    QDomElement price = doc.createElement("precio");
    QDomText priceText = doc.createTextNode("20.0");
    price.appendChild(priceText);

    newProduct.appendChild(name);
    newProduct.appendChild(price);

    // Añadir el nuevo producto al elemento raíz
    root.appendChild(newProduct);

    // Guardar el documento modificado en un archivo
    QFile file("productos_modificados.xml");
    if (!file.open(QIODevice::WriteOnly | QIODevice::Text)) {
        qDebug() << "No se pudo abrir el archivo para escribir";
        return -1;
    }
    QTextStream out(&file);
    doc.save(out, 4);
    file.close();

    qDebug() << "Documento XML modificado y guardado exitosamente.";

    return app.exec();
}
```
## Explicación:
1.	Se carga un documento XML desde una cadena.
2.	Se accede al elemento raíz <productos>.
3.	Se crea un nuevo elemento <producto> con sus hijos <nombre> y <precio>.
4.	Se añade el nuevo producto al elemento raíz.
5.	Se guarda el documento modificado en un archivo llamado productos_modificados.xml.
***
### Ejercicios de Consolidación
1.	###  Cargar y Analizar un Archivo XML
- Carga un archivo XML que contenga una lista de empleados con atributos como nombre, posición y salario. Recorre el documento y muestra la información de cada empleado en la consola.
2.	### Modificar Atributos de Nodos
- Carga un documento XML y modifica los atributos de ciertos elementos. Por ejemplo, incrementa el precio de todos los productos en un 10% y guarda los cambios en un nuevo archivo.
3.	### Eliminar Nodos
- Crea una función que elimine todos los nodos que cumplan con una cierta condición. Por ejemplo, eliminar todos los productos cuyo precio sea inferior a 15.
4.	### Crear un Documento XML desde Cero
- Utiliza QDomDocument para crear un documento XML desde cero que represente un menú de restaurante, incluyendo categorías (entradas, platos principales, postres) y platos con sus respectivos precios.
***
QDomDocument es una herramienta poderosa para manejar y manipular documentos XML en Qt. Proporciona una interfaz intuitiva para navegar y modificar el árbol de nodos, lo que facilita trabajar con datos estructurados en aplicaciones Qt.



