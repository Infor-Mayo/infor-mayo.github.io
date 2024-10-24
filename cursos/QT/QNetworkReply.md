---
layout: cabeza3
---

# Clase QNetworkReply
La clase QNetworkReply es parte del módulo Qt Network y se utiliza para manejar las respuestas de una solicitud de red asíncrona en aplicaciones Qt. QNetworkReply hereda de QIODevice, lo que significa que puedes leer los datos de la respuesta como si fuera un flujo de entrada.
Esta clase es fundamental para trabajar con operaciones HTTP como descargar archivos, obtener datos de servidores web o realizar solicitudes a APIs.
***
## Características Principales
- Maneja respuestas HTTP (GET, POST, etc.).
- Soporta transferencia de datos en curso y permite leer los resultados de forma incremental.
- Proporciona información adicional, como los encabezados HTTP y el estado de la solicitud.
- Utiliza señales para notificar cuando la solicitud ha terminado o si hubo algún error.
***
## Métodos Principales
1. ### Acceso a Datos de Respuesta
    - QByteArray readAll()

    Este método devuelve todos los datos que han sido recibidos en la respuesta, en formato de bytes.
    ```cpp
    QByteArray data = reply->readAll();
    ```
    - qint64 bytesAvailable() const

    Devuelve la cantidad de datos disponibles que se pueden leer de inmediato sin bloqueo.
    ```cpp
    qint64 availableData = reply->bytesAvailable();
    ```
2. ### Encabezados HTTP
    - QVariant header(QNetworkRequest::KnownHeaders header) const

    Devuelve el valor de un encabezado HTTP conocido. Puedes consultar encabezados como ContentTypeHeader o ContentLengthHeader.
    ```cpp
    QVariant contentType = reply->header(QNetworkRequest::ContentTypeHeader);
    ```
    - QList<QNetworkReply::RawHeaderPair> rawHeaderPairs() const

    Devuelve una lista de pares encabezado/valor para todos los encabezados recibidos en bruto.
    ```cpp
    QList<QNetworkReply::RawHeaderPair> headers = reply->rawHeaderPairs();
    ```
3. ### Estado de la Solicitud
    - QNetworkReply::NetworkError error() const

    Devuelve un valor enumerado que describe el error de red, si lo hubiera. Esto es útil para diagnosticar problemas de conexión o de respuesta del servidor.
    ```cpp
    if (reply->error() != QNetworkReply::NoError) {
        qWarning() << "Error en la solicitud:" << reply->errorString();
    }
    ```
    - QUrl url() const

    Devuelve la URL a la cual se hizo la solicitud.

    ```cpp
    QUrl requestUrl = reply->url();
    ```
4. ### Cancelar o Redirigir Solicitudes
    - void abort()

    Cancela la solicitud en curso.
    ```cpp
    reply->abort();
    ```
    - void ignoreSslErrors()

    Ignora los errores SSL que puedan ocurrir durante una solicitud segura.
    ```cpp
    reply->ignoreSslErrors();
    ```
5. ### Señales Importantes
    - void finished()

    Señal emitida cuando la solicitud ha terminado (correctamente o con error).
    ```cpp
    connect(reply, &QNetworkReply::finished, this, &MyClass::handleFinished);

    - void errorOccurred(QNetworkReply::NetworkError code)
    Señal emitida cuando ocurre un error de red.
    ```cpp
    connect(reply, &QNetworkReply::errorOccurred, this, &MyClass::handleError);
    ```
    - void downloadProgress(qint64 bytesReceived, qint64 bytesTotal)

    Señal emitida periódicamente para indicar el progreso de una descarga.
    ```cpp
    connect(reply, &QNetworkReply::downloadProgress, this, &MyClass::handleDownloadProgress);
    ```
***
## Ejemplo Completo
Este ejemplo demuestra cómo hacer una solicitud HTTP GET usando QNetworkAccessManager y procesar la respuesta con QNetworkReply.
main.cpp
```cpp
#include <QCoreApplication>
#include <QNetworkAccessManager>
#include <QNetworkReply>
#include <QUrl>
#include <QDebug>

class NetworkExample : public QObject {
    Q_OBJECT

public:
    NetworkExample(QObject *parent = nullptr) : QObject(parent) {
        manager = new QNetworkAccessManager(this);

        // Conectar la señal finished
        connect(manager, &QNetworkAccessManager::finished, this, &NetworkExample::onFinished);

        // Hacer una solicitud GET
        QUrl url("https://jsonplaceholder.typicode.com/posts/1");
        QNetworkRequest request(url);
        manager->get(request);
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
En este ejemplo, hacemos una solicitud GET a un servidor de prueba y mostramos la respuesta o el error en la consola.
***
## Ejercicios de Consolidación
1.	### Hacer una solicitud POST
    -  Modifica el ejemplo anterior para enviar una solicitud POST con algunos datos en el cuerpo de la solicitud. Asegúrate de manejar la respuesta correctamente.
2.	### Descarga de Archivos
    -  Crea una aplicación que descargue un archivo desde una URL y muestre el progreso de la descarga utilizando la señal downloadProgress.
3.	### Manejo de Errores SSL
    -  Crea un programa que haga una solicitud a un servidor HTTPS que tenga un certificado SSL no confiable. Usa ignoreSslErrors() para omitir los errores SSL y asegura que el programa maneje otros tipos de errores correctamente.
***
La clase QNetworkReply es esencial para manejar la interacción de tu aplicación con servidores web y servicios en línea. Permite recibir datos, manejar errores y monitorear el progreso de las transferencias de datos.

