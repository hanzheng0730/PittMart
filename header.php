<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
        <title>PittMart</title>
        <link rel="icon" href="icon.png" sizes="32x32" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/afeld/bootstrap-toc/v1.0.0/dist/bootstrap-toc.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.rawgit.com/afeld/bootstrap-toc/v1.0.0/dist/bootstrap-toc.min.js"></script>
        <script src="main.js"></script>
        <script src="Chart.bundle.min.js"></script>
        <script src="utils.js"></script>
        <style>
body {
font: 400 15px/1.8 Lato, sans-serif;
color: #333;
}
h3 {
margin: 10px 0 30px 0;
    letter-spacing: 2px;
    font-size: 20px;
color: #111;
}

h4 {
margin: 10px 0 0px 0;
    letter-spacing: 0px;
    font-size: 12px;
color: #ccc;
}

h2 {
margin: 10px 0 30px 0;
    letter-spacing: 10px;
    font-size: 20px;
color: #111;
}
.container {
padding: 10px 30px;
}
label {
    font-weight: normal;
    font-size:14px;
}


.img-container {
position: relative;
    text-align: center;
}
.img-centered {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
}

.img-label{
bottom: 0; /* At the bottom. Use top:0 to append it to the top */
background: rgb(0, 0, 0); /* Fallback color */
background: rgba(0, 0, 0, 0); /* Black background with 0.5 opacity */
color: #f1f1f1; /* Grey text */
width: 100%; /* Full width */
padding: 25px; /* Some padding */
}
.img-label:hover {
    background: rgba(0, 0, 0, 0.2);;
}


.scrollable-menu {
height: auto;
    max-height: 600px;
    overflow-x: hidden;
}


.top-buffer { margin-top:20px; }
.person {
border: 10px solid transparent;
    margin-bottom: 25px;
width: 80%;
height: 80%;
opacity: 0.7;
}
.person:hover {
    border-color: #f1f1f1;
}
.carousel-inner img {
    -webkit-filter: grayscale(90%);
filter: grayscale(90%); /* make all photos black and white */
width: 100%; /* Set width to 100% */
margin: auto;
}
.carousel-caption h3 {
color: #fff !important;
}
@media (max-width: 600px) {
    .carousel-caption {
    display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
    }
}
.bg-1 {
background: #2d2d30;
color: #bdbdbd;
}
.bg-1 h3 {color: #fff;}
    .bg-1 p {font-style: italic;}
    .list-group-item:first-child {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
    .list-group-item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .thumbnail {
    padding: 0 0 15px 0;
    border: none;
        border-radius: 0;
    }
    .thumbnail p {
        margin-top: 15px;
    color: #555;
    }
.navbar .btn {
  /* padding: 4.5px 10px; */
    background-color: #2d2d30;
    color: #f1f1f1;
    border-radius: 0;
    transition: .2s;
    }
.navbar .btn:hover, .btn:focus {
border: 1px solid #2d2d30;
    background-color: #fff;
color: #000;
}
.modal-header,h2, .close {
        background-color: #333;
    color: #fff !important;
        text-align: center;
        font-size: 30px;
}
.modal-header, .modal-body {
    padding: 40px 50px;
}
.nav-tabs li a {
    color: #777;
}
#googleMap {
width: 100%;
height: 400px;
    -webkit-filter: grayscale(100%);
filter: grayscale(100%);
}
.sidebar a{
    color: #111;
}
/*
.sidebar a:hover{
color: #888 !important;
}
*/

.panel {
border: 0px solid transparent;
    border-radius:0 !important;
transition: box-shadow 0.5s;
}
.panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
}
.panel-heading {
color: #111 !important;
    background-color: #fff !important;
padding: 10px;
    border-bottom: 0px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
}
.panel-heading .btn:hover {
border: 1px solid #2d2d30;
    background-color: #2d2d30 !important;
color: #f1f1f1;
}
.panel-heading .btn {
    margin: 15px 0;
    border: 1px solid #2d2d30;
    background-color: #fff;
    color: #111;
    border-radius: 0px;
}

.del-btn:hover {
border: 0px solid #2d2d30;
    //background-color: #2d2d30 !important;
color: #777;
}
.del-btn {
margin: 15px 0;
border: 0px solid #2d2d30;
    background-color: #fff;
color: #111;
    border-radius: 0px;
}


.check-btn:hover {
border: 1px solid #2d2d30;
    background-color: #2d2d30 !important;
color: #f1f1f1;
}
.check-btn {
margin: 15px 0;
width: 140px;
border: 1px solid #2d2d30;
    background-color: #fff;
color: #111;
    border-radius: 0px;
}


.navbar, footer {
    font-family: Montserrat, sans-serif;
    margin-bottom: 0;
    background-color: #2d2d30;
border: 0;
    font-size: 11px !important;
    letter-spacing: 2px;
opacity: 0.9;
}

.navbar li a, .navbar .navbar-brand {
color: #d5d5d5 !important;
}


.navbar-nav li a:hover {
color: #fff !important;
}

.navbar-nav li.active a {
color: #fff !important;
    background-color: #29292c !important;
}

.navbar-default .navbar-toggle {
    border-color: transparent;
}
.open .dropdown-toggle {
color: #fff;
    background-color: #555 !important;
}
.dropdown-menu {
    font-size:12px;
    letter-spacing:1px;
}

.dropdown-menu li a {
color: #000 !important;
}
.dropdown-menu li a:hover {
    background-color: #666 !important;
}
footer {
    background-color: #2d2d30;
color: #f5f5f5;
padding: 32px;
}
footer a {
color: #f5f5f5;
}
footer a:hover {
color: #777;
    text-decoration: none;
}
.form-control {
    border-radius: 0;
}
textarea {
resize: none;
}

    </style>

	</head>
<body>

















		
