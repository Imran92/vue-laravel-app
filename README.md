<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="100"></a></p>

## About This Project

This project is a demo project using Laravel as the backend and VueJS as the frontend. The purpose of this project is to demonstrate how to use different feature and how to setup and structure the codes for such project. It may function as a quick template for a future project for boostrap purpose.

It is a very basic resource management system, performing basic CRUD.

## A little bit about the backend architecture

The backend functions as an API for the frontend. There's no authentication here. There's one controller for serving the data to frontend. Only one Razor page is used for serving as the Root of the Vue App.

Though not needed in the scope or scale of the project, repository pattern is used for demonstration purpose. IOC is used with Provider for injecting Service and Repository.

The repositories use Eloquent ORM for communicating with the database.

Unit test is also added to the project. Tests don't cover all the cases. But it's there to demonstrate how to use it. A couple of positive and negative assertions are added. Also it shows how to test both individual classes and APIs and assert their respentive responses.

The unit tests are run in a seperate in-memory SQlite database. Should keep an eye on .env.testing and phpunit.xml for proper configuration before use, or it may cause issues with the real database.

## A bit about the frontend

The frontend is a simple VueJS SPA.

It makes use of the Vue Router for routing and Axios for HTTP communications. It also shows some breaking down of bigger components to reusable smaller ones, sending data via Props and Subscribing to child events.

Most of the data is managed by the components themselves in their inner states. But for demo, Vuex is used as the global store with one global state and a mutation for that.

It also shows uses of some useful third party components including Embedded PDF viewer, customizable Code editor, SweetAlert for nice Toast notifications etc.

There's some route guard in place as well. Instead of common ways of authentication, it depends on the store state and allows/disallowes certain routes.