---
layout: cabeza3
---

# Clase QNetworkAccessManager
QNetworkAccessManager es una clase de Qt que gestiona todas las operaciones relacionadas con redes. Proporciona una interfaz para realizar solicitudes de red como HTTP, HTTPS y FTP. Permite realizar peticiones como GET, POST, PUT, y DELETE, y gestionar respuestas y errores. Se utiliza comúnmente para descargar archivos, acceder a APIs RESTful, o enviar datos a un servidor.
## Herencia
QNetworkAccessManager hereda de QObject, lo que le permite aprovechar las señales y slots de Qt.
## Funciones Principales de QNetworkAccessManager
1.	### QNetworkReply* get(const QNetworkRequest &request)
    Envía una solicitud HTTP GET al servidor especificado por el QNetworkRequest y devuelve un objeto QNetworkReply que contendrá la respuesta del servidor.
    - Uso típico: Para descargar contenido o acceder a una API.
2.	### QNetworkReply* post(const QNetworkRequest &request, const QByteArray &data)
    Envía una solicitud HTTP POST con los datos proporcionados. El objeto QNetworkReply contendrá la respuesta.
    - Uso típico: Para enviar datos a un servidor.
3.	### QNetworkReply* put(const QNetworkRequest &request, const QByteArray &data)
    Envía una solicitud HTTP PUT con datos para reemplazar o crear recursos en el servidor.
    - Uso típico: Para actualizar o crear datos en el servidor.
4.	### QNetworkReply* deleteResource(const QNetworkRequest &request)
    Envía una solicitud HTTP DELETE para eliminar el recurso especificado en el servidor.
    - Uso típico: Para borrar recursos en un servidor.
5.	### QNetworkReply* head(const QNetworkRequest &request)
    Envía una solicitud HTTP HEAD. Es similar a GET, pero solo devuelve las cabeceras y no el cuerpo de la respuesta.
    - Uso típico: Para obtener información sobre un recurso sin descargar su contenido.
6.	### void setProxy(const QNetworkProxy &proxy)
    Configura un proxy para las solicitudes de red.
    - Uso típico: Para especificar un proxy si tu red requiere uno para el acceso a Internet.
7.	### void setCache(QAbstractNetworkCache *cache)
    Establece una caché para las respuestas de red. Las respuestas almacenadas en la caché pueden evitar solicitudes innecesarias al servidor.
    - Uso típico: Para mejorar el rendimiento al reducir las solicitudes de red repetidas.
8.	### QNetworkCookieJar* cookieJar() const
    Devuelve el QNetworkCookieJar asociado, que contiene las cookies manejadas por la clase.
    - Uso típico: Para acceder o modificar cookies asociadas con las solicitudes de red.
9.	### void setCookieJar(QNetworkCookieJar *cookieJar)
    Establece un nuevo QNetworkCookieJar.
    - Uso típico: Para personalizar el manejo de cookies.
***
## Ejemplo Básico: Descarga de Datos con GET
```cpp
#include <QApplication>
#include <QNetworkAccessManager>
#include <QNetworkReply>
#include <QNetworkRequest>
#include <QUrl>
#include <QDebug>

void onFinished(QNetworkReply *reply) {
    if (reply->error() == QNetworkReply::NoError) {
        QByteArray response = reply->readAll();
        qDebug() << "Downloaded content:" << response;
    } else {
        qDebug() << "Error occurred:" << reply->errorString();
    }
    reply->deleteLater();
}

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    QNetworkAccessManager manager;
    QObject::connect(&manager, &QNetworkAccessManager::finished, &onFinished);

    QUrl url("https://jsonplaceholder.typicode.com/todos/1");
    QNetworkRequest request(url);

    manager.get(request);  // Realiza la solicitud GET

    return app.exec();
}
```
En este ejemplo:
- get(): Envía una solicitud HTTP GET a la URL especificada.
- onFinished(): Se conecta a la señal finished() de QNetworkAccessManager para procesar la respuesta cuando esté disponible.
Ejemplo: Envío de Datos con POST
```cpp
#include <QApplication>
#include <QNetworkAccessManager>
#include <QNetworkReply>
#include <QNetworkRequest>
#include <QUrl>
#include <QByteArray>
#include <QDebug>

void onFinished(QNetworkReply *reply) {
    if (reply->error() == QNetworkReply::NoError) {
        QByteArray response = reply->readAll();
        qDebug() << "Server response:" << response;
    } else {
        qDebug() << "Error occurred:" << reply->errorString();
    }
    reply->deleteLater();
}

int main(int argc, char *argv[])
{
    QApplication app(argc, argv);

    QNetworkAccessManager manager;
    QObject::connect(&manager, &QNetworkAccessManager::finished, &onFinished);

    QUrl url("https://jsonplaceholder.typicode.com/posts");
    QNetworkRequest request(url);
    request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");

    QByteArray data = R"({"title":"foo","body":"bar","userId":1})";

    manager.post(request, data);  // Realiza la solicitud POST con datos

    return app.exec();
}
```
En este ejemplo:
- post(): Envía una solicitud HTTP POST con un cuerpo JSON.
- setHeader(): Configura el tipo de contenido de la solicitud a "application/json".
***
## Manejo de Errores
Es importante manejar los errores al hacer solicitudes de red, ya que podrían fallar debido a problemas como falta de conectividad o errores del servidor. QNetworkReply tiene el método error() que devuelve un código de error, y puedes usar errorString() para obtener una descripción textual.
```cpp
void onFinished(QNetworkReply *reply) {
    if (reply->error() == QNetworkReply::NoError) {
        QByteArray response = reply->readAll();
        qDebug() << "Response received:" << response;
    } else {
        qDebug() << "Network error:" << reply->errorString();
    }
    reply->deleteLater();
}
```
***
## Ejercicios de Consolidación
1.	### Realizar una solicitud GET y mostrar la respuesta en una interfaz: 
    - Crea una aplicación donde puedas ingresar una URL en un QLineEdit y realizar una solicitud GET al presionar un botón. Muestra la respuesta en un QTextEdit.
2.	### Enviar un formulario con POST: 
    - Implementa una aplicación que simule el envío de un formulario usando POST. Usa un QLineEdit para ingresar datos y envíalos a una API simulada. Muestra la respuesta en la interfaz.
3.	### Descargar un archivo usando QNetworkAccessManager: 
    - Crea una aplicación que permita descargar un archivo desde una URL especificada. Muestra una barra de progreso mientras el archivo se descarga y guarda el archivo en el disco local.
4. ### Manejo de Cookies: 
    - Implementa una aplicación que realice una solicitud HTTP y almacene las cookies recibidas en un QNetworkCookieJar. Luego, realiza una segunda solicitud que envíe esas cookies al servidor.
5.	### Simulación de API RESTful: 
    - Crea una interfaz que simule una interacción con una API RESTful. Implementa botones para realizar solicitudes GET, POST, PUT y DELETE a una API pública, y muestra los resultados en una tabla o área de texto.
***
Estos ejercicios ayudarán a consolidar el manejo de operaciones de red y la interacción con servicios web usando QNetworkAccessManager, dándote una comprensión sólida de cómo realizar tareas de red en aplicaciones Qt.

