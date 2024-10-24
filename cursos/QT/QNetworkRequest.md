---
layout: cabeza3
---

# Clase QNetworkRequest
La clase QNetworkRequest es parte del módulo Qt Network y representa una solicitud de red que puede ser enviada a través de un QNetworkAccessManager. Es utilizada para configurar los detalles de una solicitud HTTP/HTTPS, como la URL, los encabezados, el tipo de contenido y otras propiedades.
QNetworkRequest es un componente clave para realizar solicitudes GET, POST u otras operaciones HTTP hacia servidores y servicios en línea.
***
## Características Principales
- Configura la URL y los parámetros de solicitud.
- Define encabezados HTTP personalizados.
- Especifica el método de transferencia de datos y sus características.
- Soporta configuraciones avanzadas, como política de caché y seguridad.
***
## Métodos Principales
1. ### Configuración de la URL
    - QNetworkRequest(const QUrl &url)

    Constructor que inicializa la solicitud con una URL específica.
    ```cpp
    QNetworkRequest request(QUrl("https://jsonplaceholder.typicode.com/posts"));
    ```
    - void setUrl(const QUrl &url)

    Establece o actualiza la URL de la solicitud.
    ```cpp
    request.setUrl(QUrl("https://api.example.com/data"));
    ```
    - QUrl url() const

    Devuelve la URL asociada a la solicitud.
    ```cpp
    QUrl currentUrl = request.url();
    ```
2. ### Encabezados HTTP
    - void setHeader(QNetworkRequest::KnownHeaders header, const QVariant &value)
    
    Establece un encabezado HTTP conocido, como ContentTypeHeader o ContentLengthHeader.
    ```cpp
    request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
    - QVariant header(QNetworkRequest::KnownHeaders header) const
    ```
    Devuelve el valor de un encabezado HTTP conocido.
    ```cpp
    QVariant contentType = request.header(QNetworkRequest::ContentTypeHeader);
    ```
    - void setRawHeader(const QByteArray &headerName, const QByteArray &value)

    Establece un encabezado HTTP personalizado no estandarizado.
    ```cpp
    request.setRawHeader("Authorization", "Bearer token_xyz");
    ```
    - QByteArray rawHeader(const QByteArray &headerName) const

    Devuelve el valor de un encabezado HTTP personalizado.
    ```cpp
    QByteArray authHeader = request.rawHeader("Authorization");
    ```
3. ### Métodos Avanzados
    - void setPriority(QNetworkRequest::Priority priority)

    Establece la prioridad de la solicitud. Qt define varias prioridades como HighPriority, NormalPriority, y LowPriority.
    ```cpp
    request.setPriority(QNetworkRequest::HighPriority);
    ```
    - void setAttribute(QNetworkRequest::Attribute code, const QVariant &value)

    Establece un atributo de la solicitud. Los atributos permiten configurar aspectos adicionales como la política de caché o el tipo de transferencia.
    ```cpp
    request.setAttribute(QNetworkRequest::FollowRedirectsAttribute, true);
    ```
    - QVariant attribute(QNetworkRequest::Attribute code, const QVariant &defaultValue = QVariant()) const

    Devuelve el valor de un atributo de la solicitud.
    ```cpp
    bool followRedirects = request.attribute(QNetworkRequest::FollowRedirectsAttribute).toBool();
    ```
4. ### Política de Caché
    - void setCacheLoadControl(QNetworkRequest::CacheLoadControl mode)
    
    Configura el comportamiento de la caché para la solicitud. Qt ofrece opciones como AlwaysNetwork (siempre solicita al servidor) y PreferCache (utiliza caché si es posible).
    ```cpp
    request.setCacheLoadControl(QNetworkRequest::PreferCache);
    ```
    - CacheLoadControl cacheLoadControl() const
    
    Devuelve el modo de uso de caché configurado para la solicitud.
    ```cpp
    QNetworkRequest::CacheLoadControl cacheControl = request.cacheLoadControl();
    ```
5. ### Manejo de SSL
    - void setSslConfiguration(const QSslConfiguration &config)
    
    Establece la configuración SSL/TLS para la solicitud, permitiendo personalizar aspectos como los certificados de cliente y el protocolo SSL.
    ```cpp
    QSslConfiguration sslConfig = request.sslConfiguration();
    sslConfig.setPeerVerifyMode(QSslSocket::VerifyNone);
    request.setSslConfiguration(sslConfig);
    ```
***
## Ejemplo Completo
Aquí te presento un ejemplo de cómo realizar una solicitud HTTP POST utilizando QNetworkRequest junto con QNetworkAccessManager.
main.cpp
```cpp
#include <QCoreApplication>
#include <QNetworkAccessManager>
#include <QNetworkRequest>
#include <QNetworkReply>
#include <QUrl>
#include <QDebug>
#include <QJsonDocument>
#include <QJsonObject>

class NetworkExample : public QObject {
    Q_OBJECT

public:
    NetworkExample(QObject *parent = nullptr) : QObject(parent) {
        manager = new QNetworkAccessManager(this);

        // Conectar la señal finished
        connect(manager, &QNetworkAccessManager::finished, this, &NetworkExample::onFinished);

        // Hacer una solicitud POST
        QUrl url("https://jsonplaceholder.typicode.com/posts");
        QNetworkRequest request(url);
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");

        // Crear un objeto JSON
        QJsonObject json;
        json["title"] = "Test Title";
        json["body"] = "This is a test post.";
        json["userId"] = 1;

        // Convertir el objeto JSON en bytes
        QJsonDocument jsonDoc(json);
        QByteArray jsonData = jsonDoc.toJson();

        // Enviar la solicitud
        manager->post(request, jsonData);
    }

private slots:
    void onFinished(QNetworkReply *reply) {
        if (reply->error() == QNetworkReply::NoError) {
            // Leer la respuesta
            QByteArray response = reply->readAll();
            qDebug() << "Respuesta recibida:" << response;
        } else {
            qDebug() << "Error en la solicitud:" << reply->errorString();
        }

        // Liberar el recurso
        reply->deleteLater();
    }

private:
    QNetworkAccessManager *manager;
};

int main(int argc, char *argv[]) {
    QCoreApplication app(argc, argv);

    NetworkExample example;

    return app.exec();
}

#include "main.moc"
```
En este ejemplo, se realiza una solicitud POST a un servidor de prueba, enviando datos en formato JSON. Luego, el programa maneja la respuesta y muestra el resultado en la consola.
***

## Ejercicios de Consolidación
1.	### Solicitudes GET y Manejo de Encabezados
    - Crea una aplicación que realice una solicitud HTTP GET y que utilice un encabezado HTTP personalizado, como un token de autenticación. Muestra los datos recibidos y cualquier encabezado relevante en la consola.
2.	### Configuración de SSL
    - Realiza una solicitud a un servidor HTTPS. Configura las opciones de SSL para permitir o bloquear certificados no confiables, utilizando setSslConfiguration().
3.	### Uso de la Caché
    - Modifica la aplicación para que primero intente obtener la respuesta de la caché local antes de realizar una nueva solicitud. Experimenta con los diferentes modos de caché (AlwaysNetwork, PreferCache, etc.).
4.	### Solicitud POST con Datos de Formulario
    - Crea una aplicación que realice una solicitud HTTP POST, enviando datos de un formulario (x-www-form-urlencoded). Por ejemplo, simula el envío de datos de inicio de sesión a un servidor.
***
La clase QNetworkRequest es esencial para configurar adecuadamente cualquier solicitud de red en una aplicación Qt. Con ella, puedes personalizar las solicitudes HTTP, configurar encabezados, gestionar la caché, y realizar ajustes avanzados para solicitudes seguras con SSL.

