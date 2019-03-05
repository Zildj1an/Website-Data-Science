# Website-Data-Science 📈️
This is the website code (both server and front-end) that shows data visualization, KPIs and metrics computed with data from customers (via DDBB) applying Data Science techniques.
At the moment the website is hosted by University of Leiden [here](http://liacs.leidenuniv.nl/~s2385937/index.html)

![Website appearance](https://github.com/Zildj1an/Website-Data-Science/blob/master/screenshots/1.png)

# How does it work?
 The PHPs query data from the SQL Server and deliver it as JSON in the required format. The plots and the KPIs defined in the HTML files have an id. The appropriate JavaScript files for the plots and KPIs are embedded in the bottom of the HTML files. The JavaScript will then make an AJAX call to the PHP file to get the JSON and then it will use the JSON data and the id to set the plot or the KPIs. For the plots it is used the open-source JavaScript library Echarts (Apache License V2) and we also used Bootstrap framework for adquiring a Gentelella template by [Colorlib](https://colorlib.com/)

![](https://github.com/Zildj1an/Website-Data-Science/blob/master/screenshots/2.png)
![](https://github.com/Zildj1an/Website-Data-Science/blob/master/screenshots/3.png)
![](https://github.com/Zildj1an/Website-Data-Science/blob/master/screenshots/4.png)

# Contributor
 * Carlos Bilbao
 * Halil Gocer
