---
layout: cabeza1
title: "Qt"
description: "Curso de Qt en español: QObject, QFile, QTimer, widgets, redes y ejemplos prácticos para crear aplicaciones de escritorio."
image: /assets/images/image.png
---

<p class="eyebrow">Curso · Programación</p>
<h1>Qt en español</h1>
<p class="lead">Aprende Qt desde las clases básicas hasta los widgets y las tareas de red, con explicaciones y ejemplos pensados para quien empieza.</p>

<p>Qt es un conjunto de bibliotecas para crear aplicaciones de escritorio y móviles con C++. En este curso voy documentando las clases que uso en mis propios proyectos, con ejemplos que puedes adaptar.</p>

<div class="notice">
  <strong>Curso en progreso.</strong> Las páginas se van ampliando poco a poco. Si echas en falta una clase o un ejemplo, puedes sugerirlo en la página de <a href="{{ '/consultas.html' | relative_url }}">consultas</a>.
</div>

<h2>Clases y temas</h2>
<div class="card-grid">
  <div class="card">
    <h3>Fundamentos</h3>
    <p>El punto de partida: objetos, aplicación y depuración.</p>
    <ul class="link-list">
      <li><a href="./QObject.html">QObject</a></li>
      <li><a href="./QCoreApplication.html">QCoreApplication</a></li>
      <li><a href="./QDebug.html">QDebug</a></li>
      <li><a href="./QEvent.html">QEvent</a></li>
      <li><a href="./QException.html">QException</a></li>
    </ul>
  </div>
  <div class="card">
    <h3>Archivos y datos</h3>
    <p>Leer, escribir y organizar información.</p>
    <ul class="link-list">
      <li><a href="./QFile.html">QFile</a></li>
      <li><a href="./QFileInfo.html">QFileInfo</a></li>
      <li><a href="./QDir.html">QDir</a></li>
      <li><a href="./QDirIterator.html">QDirIterator</a></li>
      <li><a href="./QBuffer.html">QBuffer</a></li>
      <li><a href="./QDataStream.html">QDataStream</a></li>
    </ul>
  </div>
  <div class="card">
    <h3>Fechas y utilidades</h3>
    <p>Tiempo, cifrado y tareas del sistema.</p>
    <ul class="link-list">
      <li><a href="./QDate.html">QDate</a></li>
      <li><a href="./QDateTime.html">QDateTime</a></li>
      <li><a href="./QTimer.html">QTimer</a></li>
      <li><a href="./QLocale.html">QLocale</a></li>
      <li><a href="./QCryptographicHash.html">QCryptographicHash</a></li>
      <li><a href="./QDesktopServices.html">QDesktopServices</a></li>
    </ul>
  </div>
  <div class="card">
    <h3>Interfaz</h3>
    <p>Ventanas, controles y distribución de la pantalla.</p>
    <ul class="link-list">
      <li><a href="./QMainWindow.html">QMainWindow</a></li>
      <li><a href="./QLabel.html">QLabel</a></li>
      <li><a href="./QLineEdit.html">QLineEdit</a></li>
      <li><a href="./QComboBox.html">QComboBox</a></li>
      <li><a href="./QCheckBox.html">QCheckBox</a></li>
      <li><a href="./QListWidget.html">QListWidget</a></li>
      <li><a href="./QDialog.html">QDialog</a></li>
      <li><a href="./QFileDialog.html">QFileDialog</a></li>
      <li><a href="./QFormLayout.html">QFormLayout</a></li>
      <li><a href="./QGridLayout.html">QGridLayout</a></li>
      <li><a href="./QHBoxLayout.html">QHBoxLayout</a></li>
    </ul>
  </div>
  <div class="card">
    <h3>Gráficos y multimedia</h3>
    <p>Imágenes, video y escenas gráficas.</p>
    <ul class="link-list">
      <li><a href="./QImage.html">QImage</a></li>
      <li><a href="./QMovie.html">QMovie</a></li>
      <li><a href="./QMediaPlayer.html">QMediaPlayer</a></li>
      <li><a href="./QGraphicsScene.html">QGraphicsScene</a></li>
      <li><a href="./QGraphicsView.html">QGraphicsView</a></li>
      <li><a href="./QGraphicsItem.html">QGraphicsItem</a></li>
      <li><a href="./QOpenGLFunctions.html">QOpenGLFunctions</a></li>
    </ul>
  </div>
  <div class="card">
    <h3>Red y eventos</h3>
    <p>Peticiones HTTP, teclado, ratón y portapapeles.</p>
    <ul class="link-list">
      <li><a href="./QNetworkAccessManager.html">QNetworkAccessManager</a></li>
      <li><a href="./QNetworkRequest.html">QNetworkRequest</a></li>
      <li><a href="./QNetworkReply.html">QNetworkReply</a></li>
      <li><a href="./QKeyEvent.html">QKeyEvent</a></li>
      <li><a href="./QMouseEvent.html">QMouseEvent</a></li>
      <li><a href="./QClipboard.html">QClipboard</a></li>
      <li><a href="./QMimeData.html">QMimeData</a></li>
    </ul>
  </div>
  <div class="card">
    <h3>JSON y contenedores</h3>
    <p>Datos estructurados y colecciones.</p>
    <ul class="link-list">
      <li><a href="./QJsonDocument.html">QJsonDocument</a></li>
      <li><a href="./QJsonArray.html">QJsonArray</a></li>
      <li><a href="./QJsonObject.html">QJsonObject</a></li>
      <li><a href="./QList.html">QList</a></li>
      <li><a href="./QMap.html">QMap</a></li>
      <li><a href="./QDomDocument.html">QDomDocument</a></li>
    </ul>
  </div>
  <div class="card">
    <h3>Sensores y dispositivos</h3>
    <p>Cámara, audio, ubicación y Bluetooth.</p>
    <ul class="link-list">
      <li><a href="./QAccelerometer.html">QAccelerometer</a></li>
      <li><a href="./QCamera.html">QCamera</a></li>
      <li><a href="./QAudioInput.html">QAudioInput</a></li>
      <li><a href="./QAudioOutput.html">QAudioOutput</a></li>
      <li><a href="./QAudioDeviceInfo.html">QAudioDeviceInfo</a></li>
      <li><a href="./QBluetoothDeviceInfo.html">QBluetoothDeviceInfo</a></li>
      <li><a href="./QGeoPositionInfoSource.html">QGeoPositionInfoSource</a></li>
    </ul>
  </div>
</div>

<h2>Por dónde empezar</h2>
<p>Si es tu primera vez con Qt, empieza por <a href="./QCoreApplication.html">QCoreApplication</a> y <a href="./QObject.html">QObject</a>. Después pasa a <a href="./QFile.html">QFile</a> para entender el manejo de archivos y a <a href="./QMainWindow.html">QMainWindow</a> cuando quieras construir una ventana.</p>

<p>
  <a class="btn btn-primary" href="https://www.youtube.com/@Infor-Mayo/search?query=qt" target="_blank" rel="noopener">Ver videos de Qt</a>
  <a class="btn btn-ghost" href="{{ '/cursos.html' | relative_url }}">Volver a cursos</a>
</p>

<p class="small">Los ejemplos usan C++ y Qt. Si encuentras un error o quieres proponer una clase, escríbeme por <a href="https://api.whatsapp.com/send?phone=5353510750&text=Hola%2C%20Mario.%20Tengo%20una%20consulta%20del%20curso%20de%20Qt." target="_blank" rel="noopener">WhatsApp</a>.</p>
