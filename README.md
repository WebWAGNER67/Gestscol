# Webpack Mix Configuration Documentation

This documentation provides an overview of the `webpack.mix.js` file used in a web development project. This file is crucial for defining how assets like JavaScript and CSS should be compiled and processed. Let's break down the content and functionalities provided in this configuration file.

## Overview

The `webpack.mix.js` file is a configuration file for Laravel Mix, which provides a fluent API for defining Webpack build steps for your application. Laravel Mix supports several common CSS and JavaScript pre-processors out-of-the-box.

## Key Components

### Environment Configuration

```javascript
require("dotenv").config();
```

-   **Purpose**: Loads environment variables from a `.env` file into `process.env`.
-   **Why it's used**: This allows you to use environment-specific variables within your webpack mix configuration, making it more flexible and secure.

### Laravel Mix Setup

```javascript
const mix = require("laravel-mix");
```

-   **Purpose**: Imports the Laravel Mix module.
-   **Why it's used**: It enables you to use Laravel Mix's API to define your webpack build steps easily.

### Processing JavaScript

```javascript
mix.js("resources/js/app.js", "public/js");
```

-   **Source**: `resources/js/app.js`
-   **Destination**: `public/js`
-   **Purpose**: Compiles the `app.js` file from the resources directory to the public directory.
-   **Why it's used**: It's the entry point for your application's JavaScript, bundling any imported modules.

### Processing CSS with PostCSS and TailwindCSS

```javascript
.postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
])
```

-   **Source**: `resources/css/app.css`
-   **Destination**: `public/css`
-   **Purpose**: Processes the `app.css` file through PostCSS and uses TailwindCSS as a plugin.
-   **Why it's used**: It enables the use of TailwindCSS utility-first CSS framework for styling applications.

### Custom Webpack Configuration

```javascript
.webpackConfig(require("./webpack.config"))
```

-   **Purpose**: Merges a custom webpack configuration file with Laravel Mix's default configuration.
-   **Why it's used**: It allows for custom webpack configuration, such as adding loaders, plugins, or modifying existing configurations to suit your project's needs.

### Versioning / Cache Busting

```javascript
if (mix.inProduction()) {
    mix.version();
}
```

-   **Purpose**: Enables versioning of compiled files in production environments.
-   **Why it's used**: It appends a unique hash to filenames (e.g., `app.js` becomes `app.76d77f24.js`) to prevent browsers from using cached versions after updates.

## Summary

The `webpack.mix.js` file in a project configures how assets are compiled and processed. It uses Laravel Mix to simplify and streamline the management of webpack tasks. This setup includes compiling JavaScript and CSS (with TailwindCSS), custom webpack configurations, and enabling cache busting in production environments. The usage of environment variables and conditional checks for the production environment ensures that the build process is both flexible and optimized for different deployment scenarios.

# Vite Configuration for Laravel Project

This documentation provides an overview of the `vite.config.js` file used in a Laravel project to configure Vite. Vite is a modern build tool that significantly improves the frontend development experience.

## Overview

The `vite.config.js` file is crucial for setting up Vite in a Laravel project. It defines how Vite should process the project's assets, including CSS and JavaScript files. The configuration utilizes the `laravel-vite-plugin` to seamlessly integrate with Laravel's workflow.

## Configuration Details

Below is a breakdown of the key components in the `vite.config.js` file:

### Import Statements

```javascript
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
```

-   `defineConfig`: A helper function from Vite that simplifies the process of defining the configuration object.
-   `laravel`: Imports the `laravel-vite-plugin` which is designed to work specifically with Laravel, enhancing the integration between Laravel and Vite.

### Configuration Object

```javascript
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
```

-   **Plugins**: An array of plugins used by Vite. In this case, it includes a single plugin, `laravel-vite-plugin`.
-   **laravel-vite-plugin**: Configured with two main options:
    -   **input**: Specifies the entry points for the application. These are the files that Vite will use to start the build process. In this case, it includes `app.css` and `app.js` located in the `resources/css` and `resources/js` directories, respectively.
    -   **refresh**: Enables automatic page refresh when the source files change. This is set to `true` to improve the development experience by providing instant feedback on changes.

## Summary

The `vite.config.js` file is set up to use Vite with Laravel, optimizing the development workflow. It specifies the entry points for CSS and JavaScript files and enables hot reloading through the `laravel-vite-plugin`. This configuration ensures that developers can efficiently work on the project, with immediate feedback on any changes made to the code.

## Usage

1. **Installation**: Before using this configuration, ensure that Vite and `laravel-vite-plugin` are installed in your Laravel project.
1. **Running Vite**: Use the Laravel artisan command or Vite CLI to start the Vite development server.
1. **Building for Production**: When ready, build your assets for production using Vite's build command to ensure optimal performance.

This configuration is a starting point and can be customized further based on the specific needs of your project.

# Tailwind CSS Configuration Documentation

This document provides a comprehensive overview of the `tailwind.config.js` file for a web project. Tailwind CSS is a highly customizable, low-level CSS framework that gives you all of the building blocks you need to build bespoke designs without any annoying opinionated styles you have to fight to override.

## Overview

`tailwind.config.js` is a configuration file for Tailwind CSS. It's used to customize your Tailwind setup, including defining your design system (like colors, fonts, and more), enabling features, and adding plugins. This specific configuration extends the default setup with custom settings and plugins suitable for a Laravel project, including support for dark mode and custom fonts.

### Key Features

-   **Dark Mode Support:** Toggleable via a class, allowing for a user-preferred theme.
-   **Custom Fonts and Colors:** Extends the default theme with custom fonts and colors.
-   **Background Images:** Supports environment-specific background images for light and dark modes.
-   **Forms Plugin:** Integrates `@tailwindcss/forms` for better form styling.
-   **Environment Variables:** Utilizes environment variables for dynamic configuration.

## Configuration Details

Below is a detailed breakdown of the configuration settings.

### Content Paths

Specifies the files Tailwind should scan for class names:

```javascript
content: [
  "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  "./storage/framework/views/*.php",
  "./resources/views/**/*.blade.php",
],
```

### Dark Mode

Enabled with the `class` strategy, allowing toggling between light and dark modes using a class:

```javascript
darkMode: "class",
```

### Theme Customization

Extends the default theme with custom settings:

-   **Fonts:** Adds `Figtree` as the primary sans-serif font, falling back to default sans fonts if unavailable.

```javascript
fontFamily: {
  sans: ["Figtree", ...defaultTheme.fontFamily.sans],
},
```

-   **Colors:** Defines custom colors for white and black shades.

```javascript
colors: {
  white: "#dfdfdf",
  black: "#202020",
},
```

-   **Background Images:** Sets environment-based URLs for light and dark background images.

```javascript
backgroundImage: (theme) => ({
  light: `url(${process.env.APP_URL}${process.env.BG_LIGHT_IMAGE})`,
  dark: `url(${process.env.APP_URL}${process.env.BG_DARK_IMAGE})`,
}),
```

### Plugins

Incorporates the `@tailwindcss/forms` plugin for improved form elements styling:

```javascript
plugins: [forms],
```

## Conclusion

This `tailwind.config.js` setup offers a tailored approach for a Laravel-based project, leveraging Tailwind CSS's flexibility. By incorporating custom fonts, colors, and background images, it enhances the UI/UX. The use of environment variables and the forms plugin demonstrates a consideration for dynamic content and user-friendly controls. Tailwind CSS's utility-first approach, combined with these customizations, provides a solid foundation for building a unique and responsive design.

# Web.php Documentation

The `web.php` file in a Laravel application is used to define web routes. These routes handle the incoming HTTP requests to your application and return responses. Below is a detailed explanation of the `web.php` file provided, which organizes routes into various sections based on user roles and functionalities.

## Table of Contents

-   [Visitor Routes](#visitor-routes)
-   [Authenticated User Routes](#authenticated-user-routes)
    -   [General User Routes](#general-user-routes)
    -   [Student Routes](#student-routes)
    -   [Teacher Routes](#teacher-routes)
    -   [Administrator Routes](#administrator-routes)
    -   [Footer Routes](#footer-routes)
-   [Authentication Routes](#authentication-routes)

---

### Visitor Routes

| <h3><h3><h3>Method</h3></h3></h3> | <h3><h3><h3>URI</h3></h3></h3> |        <h3><h3><h3>Action</h3></h3></h3>         | <h3><h3><h3>Middleware</h3></h3></h3> |
| :-------------------------------: | :----------------------------: | :----------------------------------------------: | :-----------------------------------: |
|  <h3><h3><h3>GET</h3></h3></h3>   | <h3><h3><h3>`/`</h3></h3></h3> | <h3><h3><h3>Redirect to home page</h3></h3></h3> |    <h3><h3><h3>web</h3></h3></h3>     |

###

###

###

#### Description:

-   **Home Redirection:** Visitors accessing the root URL (`/`) are redirected to the home page.

```php
Route::get('/', function () {
    return redirect(route("home"));
});
```

---

### Authenticated User Routes

These routes are accessible only by authenticated users, grouped under various categories based on the user's role and the type of action they are performing.

#### General User Routes

| <h4><h4><h4>Method</h4></h4></h4> |       <h4><h4><h4>URI</h4></h4></h4>       |      <h4><h4><h4>Action</h4></h4></h4>       | <h4><h4><h4>Middleware</h4></h4></h4> |               <h4><h4><h4>Description</h4></h4></h4>               |
| :-------------------------------: | :----------------------------------------: | :------------------------------------------: | :-----------------------------------: | :----------------------------------------------------------------: |
|  <h4><h4><h4>GET</h4></h4></h4>   |   <h4><h4><h4>`/profile`</h4></h4></h4>    | <h4><h4><h4>Show user profile</h4></h4></h4> |    <h4><h4><h4>auth</h4></h4></h4>    | <h4><h4><h4>View the profile of the logged-in user.</h4></h4></h4> |
|  <h4><h4><h4>GET</h4></h4></h4>   | <h4><h4><h4>`/profile/edit`</h4></h4></h4> | <h4><h4><h4>Edit user profile</h4></h4></h4> |    <h4><h4><h4>auth</h4></h4></h4>    |      <h4><h4><h4>Access the profile edit page.</h4></h4></h4>      |
| <h4><h4><h4>PATCH</h4></h4></h4>  |   <h4><h4><h4>`/profile`</h4></h4></h4>    |  <h4><h4><h4>Update profile</h4></h4></h4>   |    <h4><h4><h4>auth</h4></h4></h4>    |         <h4><h4><h4>Submit profile updates.</h4></h4></h4>         |
| <h4><h4><h4>DELETE</h4></h4></h4> |   <h4><h4><h4>`/profile`</h4></h4></h4>    |  <h4><h4><h4>Destroy profile</h4></h4></h4>  |    <h4><h4><h4>auth</h4></h4></h4>    |        <h4><h4><h4>Delete the user profile.</h4></h4></h4>         |
|  <h4><h4><h4>GET</h4></h4></h4>   |     <h4><h4><h4>`/home`</h4></h4></h4>     |     <h4><h4><h4>Home page</h4></h4></h4>     |    <h4><h4><h4>auth</h4></h4></h4>    |    <h4><h4><h4>View the application's home page.</h4></h4></h4>    |

####

####

####

**Code Snippet:**

```php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // Other routes...
});
```

#### Student Routes

| <h4><h4><h4>Method</h4></h4></h4> |        <h4><h4><h4>URI</h4></h4></h4>         |      <h4><h4><h4>Action</h4></h4></h4>      | <h4><h4><h4>Middleware</h4></h4></h4> |             <h4><h4><h4>Description</h4></h4></h4>              |
| :-------------------------------: | :-------------------------------------------: | :-----------------------------------------: | :-----------------------------------: | :-------------------------------------------------------------: |
|  <h4><h4><h4>GET</h4></h4></h4>   |      <h4><h4><h4>`/group`</h4></h4></h4>      |    <h4><h4><h4>View group</h4></h4></h4>    |    <h4><h4><h4>auth</h4></h4></h4>    |     <h4><h4><h4>Display the group's profile.</h4></h4></h4>     |
|  <h4><h4><h4>GET</h4></h4></h4>   |      <h4><h4><h4>`/promo`</h4></h4></h4>      |    <h4><h4><h4>View promo</h4></h4></h4>    |    <h4><h4><h4>auth</h4></h4></h4>    |   <h4><h4><h4>Display the promotional profile.</h4></h4></h4>   |
|  <h4><h4><h4>GET</h4></h4></h4>   |    <h4><h4><h4>`/absences`</h4></h4></h4>     |  <h4><h4><h4>List absences</h4></h4></h4>   |    <h4><h4><h4>auth</h4></h4></h4>    |      <h4><h4><h4>List the user's absences.</h4></h4></h4>       |
|  <h4><h4><h4>GET</h4></h4></h4>   | <h4><h4><h4>`/presence/{cour}`</h4></h4></h4> | <h4><h4><h4>Confirm presence</h4></h4></h4> |    <h4><h4><h4>auth</h4></h4></h4>    |    <h4><h4><h4>Confirm presence in a course.</h4></h4></h4>     |
|  <h4><h4><h4>POST</h4></h4></h4>  | <h4><h4><h4>`/absence/justify`</h4></h4></h4> | <h4><h4><h4>Justify absence</h4></h4></h4>  |    <h4><h4><h4>auth</h4></h4></h4>    | <h4><h4><h4>Submit justification for an absence.</h4></h4></h4> |

####

####

####

**Code Snippet:**

```php
// Student specific routes
Route::get('/group', [ProfileController::class, 'group'])->name('group');
// Other routes...
```

#### Teacher Routes

| <h4><h4><h4>Method</h4></h4></h4> |       <h4><h4><h4>URI</h4></h4></h4>        |         <h4><h4><h4>Action</h4></h4></h4>          | <h4><h4><h4>Middleware</h4></h4></h4> |                  <h4><h4><h4>Description</h4></h4></h4>                   |
| :-------------------------------: | :-----------------------------------------: | :------------------------------------------------: | :-----------------------------------: | :-----------------------------------------------------------------------: |
|  <h4><h4><h4>GET</h4></h4></h4>   | <h4><h4><h4>`/trombinoscope`</h4></h4></h4> | <h4><h4><h4>View all trombinoscopes</h4></h4></h4> |    <h4><h4><h4>auth</h4></h4></h4>    |     <h4><h4><h4>Display trombinoscopes for all groups.</h4></h4></h4>     |
|  <h4><h4><h4>POST</h4></h4></h4>  |     <h4><h4><h4>`/scan`</h4></h4></h4>      |      <h4><h4><h4>Scan QR Code</h4></h4></h4>       |    <h4><h4><h4>auth</h4></h4></h4>    | <h4><h4><h4>Handle the scanning of a QR Code by a student.</h4></h4></h4> |

####

####

####

**Code Snippet:**

```php
// Teacher specific routes
Route::get('/trombinoscope', function() {
    return view('trombinoscope');
})->name('trombinoscope');
// Other routes...
```

#### Administrator Routes

| <h4><h4><h4>Method</h4></h4></h4> |       <h4><h4><h4>URI</h4></h4></h4>       |     <h4><h4><h4>Action</h4></h4></h4>     | <h4><h4><h4>Middleware</h4></h4></h4> |              <h4><h4><h4>Description</h4></h4></h4>              |
| :-------------------------------: | :----------------------------------------: | :---------------------------------------: | :-----------------------------------: | :--------------------------------------------------------------: |
|  <h4><h4><h4>GET</h4></h4></h4>   |    <h4><h4><h4>`/users`</h4></h4></h4>     | <h4><h4><h4>List all users</h4></h4></h4> |    <h4><h4><h4>auth</h4></h4></h4>    |          <h4><h4><h4>Display all users.</h4></h4></h4>           |
|  <h4><h4><h4>POST</h4></h4></h4>  | <h4><h4><h4>`/users-import`</h4></h4></h4> |  <h4><h4><h4>Import users</h4></h4></h4>  |    <h4><h4><h4>auth</h4></h4></h4>    | <h4><h4><h4>Import users from an external source.</h4></h4></h4> |

####

####

####

**Code Snippet:**

```php
// Administrator specific routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Other routes...
```

#### Footer Routes

These routes are related to the application's footer and include links to legal mentions, cookie policy, site map, accessibility page, and an external company website.

**Code Snippet:**

```php
// Footer specific routes
Route::get('/mentions', function() {
    return view('mentions');
})->name('mentions');
// Other routes...
```

### Authentication Routes

Finally, the `web.php` file includes authentication routes through the `auth.php` file.

```php
require __DIR__.'/auth.php';
```

This setup structures the application's web routes, ensuring a clear separation of concerns, proper authentication handling, and user-friendly navigation.

# `.env` Configuration Documentation

The `.env` file is a crucial component in many web applications. It stores environment variables which are often used for configuration purposes. These variables can influence the application's behavior, connections, and overall setup without altering the codebase. This document outlines the configuration specified in the `.env` file for the application **Gestscol**.

---

## 📜 Table of Contents

1. [**General Application Settings**](#general-application-settings)
1. [**Logging Configuration**](#logging-configuration)
1. [**ADE Configuration**](#ade-configuration)
1. [**Database Configuration**](#database-configuration)
1. [**Queue & Cache Configuration**](#queue--cache-configuration)
1. [**Mail Configuration**](#mail-configuration)
1. [**AWS Configuration**](#aws-configuration)
1. [**Pusher Configuration**](#pusher-configuration)

---

### General Application Settings

|  <h3><h3><h3>Variable</h3></h3></h3>   |              <h3><h3><h3>Value</h3></h3></h3>              |               <h3><h3><h3>Description</h3></h3></h3>                |
| :------------------------------------: | :--------------------------------------------------------: | :-----------------------------------------------------------------: |
| <h3><h3><h3>`APP_NAME`</h3></h3></h3>  |            <h3><h3><h3>Gestscol</h3></h3></h3>             |       <h3><h3><h3>The name of the application.</h3></h3></h3>       |
|  <h3><h3><h3>`APP_ENV`</h3></h3></h3>  |              <h3><h3><h3>local</h3></h3></h3>              |  <h3><h3><h3>The environment the app is running in.</h3></h3></h3>  |
|  <h3><h3><h3>`APP_KEY`</h3></h3></h3>  | <h3><h3><h3>base64:EOvqT74ZBlAyWB6JMTR6P...</h3></h3></h3> |  <h3><h3><h3>The application's key for encryption.</h3></h3></h3>   |
| <h3><h3><h3>`APP_DEBUG`</h3></h3></h3> |              <h3><h3><h3>true</h3></h3></h3>               |         <h3><h3><h3>If debugging is enabled.</h3></h3></h3>         |
|  <h3><h3><h3>`APP_URL`</h3></h3></h3>  |  <h3><h3><h3>https://gestscol.mydevosux.fr</h3></h3></h3>  | <h3><h3><h3>The URL where the application is hosted.</h3></h3></h3> |

###

###

###

### Logging Configuration

|          <h3><h3><h3>Variable</h3></h3></h3>          | <h3><h3><h3>Value</h3></h3></h3> |                   <h3><h3><h3>Description</h3></h3></h3>                    |
| :---------------------------------------------------: | :------------------------------: | :-------------------------------------------------------------------------: |
|       <h3><h3><h3>`LOG_CHANNEL`</h3></h3></h3>        | <h3><h3><h3>stack</h3></h3></h3> |           <h3><h3><h3>The default logging channel.</h3></h3></h3>           |
| <h3><h3><h3>`LOG_DEPRECATIONS_CHANNEL`</h3></h3></h3> | <h3><h3><h3>null</h3></h3></h3>  |        <h3><h3><h3>Channel for logging deprecations.</h3></h3></h3>         |
|        <h3><h3><h3>`LOG_LEVEL`</h3></h3></h3>         | <h3><h3><h3>debug</h3></h3></h3> | <h3><h3><h3>The minimum log level at which logs are written.</h3></h3></h3> |

###

###

###

### ADE Configuration

These settings are particularly for connecting to an ADE (Automatic Data Exchange) server, possibly for academic scheduling or similar purposes.

|       Variable       |        Value        |              Description              |
| :------------------: | :-----------------: | :-----------------------------------: |
|     `ADE_LOGIN`      |      ade login      |          ADE account login.           |
|    `ADE_PASSWORD`    |    ade password     |         ADE account password.         |
|    `ADE_PROTOCOL`    |    ade protocol     |   Protocol used to connect to ADE.    |
|     `ADE_SERVER`     | ade server address  |          ADE server address.          |
|  `ADE_PROXY_LOGIN`   |  your proxy login   |    Proxy login for ADE connection.    |
| `ADE_PROXY_PASSWORD` | your proxy password |  Proxy password for ADE connection.   |
|   `ADE_PROXY_URL`    |   your proxy url    |     Proxy URL for ADE connection.     |
|   `ADE_USE_PROXY`    |        true         | Indicates if a proxy is used for ADE. |

### Database Configuration

|    <h3><h3><h3>Variable</h3></h3></h3>     |       <h3><h3><h3>Value</h3></h3></h3>        |           <h3><h3><h3>Description</h3></h3></h3>            |
| :----------------------------------------: | :-------------------------------------------: | :---------------------------------------------------------: |
| <h3><h3><h3>`DB_CONNECTION`</h3></h3></h3> | <h3><h3><h3>your db connection</h3></h3></h3> |  <h3><h3><h3>The database connection type.</h3></h3></h3>   |
|    <h3><h3><h3>`DB_HOST`</h3></h3></h3>    |    <h3><h3><h3>your db host</h3></h3></h3>    |      <h3><h3><h3>Database server host.</h3></h3></h3>       |
|    <h3><h3><h3>`DB_PORT`</h3></h3></h3>    |    <h3><h3><h3>your db port</h3></h3></h3>    |      <h3><h3><h3>Database server port.</h3></h3></h3>       |
|  <h3><h3><h3>`DB_DATABASE`</h3></h3></h3>  |    <h3><h3><h3>your db name</h3></h3></h3>    | <h3><h3><h3>Name of the database to connect.</h3></h3></h3> |
|  <h3><h3><h3>`DB_USERNAME`</h3></h3></h3>  |  <h3><h3><h3>your db username</h3></h3></h3>  |      <h3><h3><h3>The database username.</h3></h3></h3>      |
|  <h3><h3><h3>`DB_PASSWORD`</h3></h3></h3>  |  <h3><h3><h3>your db password</h3></h3></h3>  |      <h3><h3><h3>The database password.</h3></h3></h3>      |

###

###

###

### Queue & Cache Configuration

|      <h3><h3><h3>Variable</h3></h3></h3>      | <h3><h3><h3>Value</h3></h3></h3> |               <h3><h3><h3>Description</h3></h3></h3>               |
| :-------------------------------------------: | :------------------------------: | :----------------------------------------------------------------: |
| <h3><h3><h3>`BROADCAST_DRIVER`</h3></h3></h3> |  <h3><h3><h3>log</h3></h3></h3>  |   <h3><h3><h3>The driver for broadcasting events.</h3></h3></h3>   |
|   <h3><h3><h3>`CACHE_DRIVER`</h3></h3></h3>   | <h3><h3><h3>file</h3></h3></h3>  |         <h3><h3><h3>The driver for caching.</h3></h3></h3>         |
| <h3><h3><h3>`FILESYSTEM_DISK`</h3></h3></h3>  | <h3><h3><h3>local</h3></h3></h3> |      <h3><h3><h3>The default filesystem disk.</h3></h3></h3>       |
| <h3><h3><h3>`QUEUE_CONNECTION`</h3></h3></h3> | <h3><h3><h3>sync</h3></h3></h3>  |      <h3><h3><h3>The default queue connection.</h3></h3></h3>      |
|  <h3><h3><h3>`SESSION_DRIVER`</h3></h3></h3>  | <h3><h3><h3>file</h3></h3></h3>  |       <h3><h3><h3>The session storage driver.</h3></h3></h3>       |
| <h3><h3><h3>`SESSION_LIFETIME`</h3></h3></h3> |  <h3><h3><h3>120</h3></h3></h3>  | <h3><h3><h3>The lifetime of the session in minutes.</h3></h3></h3> |

###

###

###

### Mail Configuration

|      <h3><h3><h3>Variable</h3></h3></h3>       |             <h3><h3><h3>Value</h3></h3></h3>              |                <h3><h3><h3>Description</h3></h3></h3>                |
| :--------------------------------------------: | :-------------------------------------------------------: | :------------------------------------------------------------------: |
|    <h3><h3><h3>`MAIL_MAILER`</h3></h3></h3>    |             <h3><h3><h3>resend</h3></h3></h3>             | <h3><h3><h3>The driver or service for sending emails.</h3></h3></h3> |
| <h3><h3><h3>`MAIL_FROM_ADDRESS`</h3></h3></h3> | <h3><h3><h3>"Acme <onboarding@resend.dev>"</h3></h3></h3> |  <h3><h3><h3>The email address emails are sent from.</h3></h3></h3>  |
|  <h3><h3><h3>`MAIL_FROM_NAME`</h3></h3></h3>   |             <h3><h3><h3>Resend</h3></h3></h3>             |   <h3><h3><h3>The name emails appear to come from.</h3></h3></h3>    |

###

###

###

### AWS Configuration

These are placeholder configurations for AWS (Amazon Web Services), which are currently empty.

### Pusher Configuration

Configuration settings for real-time web applications using Pusher.

|       Variable       | Value |     Description     |
| :------------------: | :---: | :-----------------: |
|   `PUSHER_APP_ID`    |       |   Pusher App ID.    |
|   `PUSHER_APP_KEY`   |       |   Pusher App Key.   |
| `PUSHER_APP_SECRET`  |       | Pusher App Secret.  |
|    `PUSHER_HOST`     |       |    Pusher Host.     |
|    `PUSHER_PORT`     |  443  |    Pusher Port.     |
|   `PUSHER_SCHEME`    | https |   Pusher Scheme.    |
| `PUSHER_APP_CLUSTER` |  mt1  | Pusher App Cluster. |

### Vite Configuration

Variables intended to configure the Vite, a build tool that significantly improves the frontend development experience.

|         Variable          |            Description             |
| :-----------------------: | :--------------------------------: |
|      `VITE_APP_NAME`      |      Reflects the `APP_NAME`.      |
|   `VITE_PUSHER_APP_KEY`   |   Reflects the `PUSHER_APP_KEY`.   |
|    `VITE_PUSHER_HOST`     |    Reflects the `PUSHER_HOST`.     |
|    `VITE_PUSHER_PORT`     |    Reflects the `PUSHER_PORT`.     |
|   `VITE_PUSHER_SCHEME`    |   Reflects the `PUSHER_SCHEME`.    |
| `VITE_PUSHER_APP_CLUSTER` | Reflects the `PUSHER_APP_CLUSTER`. |

---

This `.env` file configuration highlights the application's flexibility and the importance of securely managing environment variables, as they often contain sensitive information crucial for the application's operation.

# Home Page Documentation

The `home.blade.php` file is a Blade template used in Laravel applications to generate the home page view of a web application. This document outlines the structure, components, and functionalities provided by the `home.blade.php` file.

## File Overview

This Blade template is structured within a custom layout `<x-home-layout>`, indicating the use of a Blade component for the layout of the home page. The main functionalities and features include displaying the home page content, handling session status messages, showing current and next events, and displaying the timetable and absences for users with specific permissions.

### Components and Functionalities

Below is an outline of the key components and functionalities within the `home.blade.php` file:

|    Component/Functionality    |                                                                            Description                                                                            |
| :---------------------------: | :---------------------------------------------------------------------------------------------------------------------------------------------------------------: |
|  **Session Status Message**   |                                                 Displays a message (success, error, etc.) stored in the session.                                                  |
|  **Current and Next Events**  |                   Shows details about the current and next events if available, including the event name, location (classroom), date, and time.                   |
|  **Timetable and Absences**   | For users with the appropriate permissions, it displays the timetable and allows users to view absences and their status (justified, unjustified, pending, etc.). |
|     **Responsive Design**     |                                  The page layout adapts to different screen sizes using Tailwind CSS classes for responsiveness.                                  |
| **Dynamic Content Rendering** |           Uses Blade's `@if`, `@foreach`, and `@can` directives for conditional rendering based on the user's permissions and the availability of data.           |
|         **SVG Icons**         |                                                    Utilizes inline SVG for icons, enhancing the visual appeal.                                                    |
| **Toggle Timetable Display**  |                                             Includes a script to toggle the display of the timetable on button click.                                             |

### Example Code Snippets

**Displaying Session Status Message:**

```html
@if (session('status'))
<div class="p-3 text-white bg-green-500 ring-1 ring-green-700 rounded-xl">
    {{ session('status') }}
</div>
@endif
```

**Displaying Current Event:**

```html
@if (isset($currentEvent))
<!-- Event details -->
@endif
```

**Toggle Timetable Script:**

```javascript
<script>
    let emploi_button = document.querySelector('#emploi_button');
    let emploi_menu = document.querySelector('#emploi_menu');

    if (emploi) {
        emploi_button.addEventListener('click', () => {
            emploi_menu.classList.toggle('hidden');
            if (emploi_button.innerHTML == 'Afficher l'EDT') {
                emploi_button.innerHTML = 'Masquer l'EDT';
            } else {
                emploi_button.innerHTML = 'Afficher l'EDT';
            }
        });
    }
</script>
```

**Dynamic Time Formatting Function:**

```php
@php
function formatTime($time){
    $timestamp = strtotime($time);
    $formattedTime = date('H\hi', $timestamp);
    return $formattedTime;
}
@endphp
```

## Conclusion

The `home.blade.php` file is designed to provide a dynamic and responsive home page for a Laravel web application. Through the use of conditional rendering, session handling, and permissions-based content display, it offers a tailored user experience. The integration of Tailwind CSS for styling and layout makes the page visually appealing and adaptable to different screen sizes.

# `home.blade.php` Documentation

The `home.blade.php` file is a Laravel Blade template that serves as the main layout for a web application. This document explains its structure, functionality, and various components.

---

## **Table of Contents**

-   [Overview](#overview)
-   [HTML Structure](#html-structure)
-   [CSS and JavaScript Inclusions](#css-and-javascript-inclusions)
-   [Functional Components](#functional-components)
-   [JavaScript Functionality](#javascript-functionality)

---

## Overview

The file is structured as a standard HTML document with Blade template syntax for dynamic content. It includes references to CSS and JavaScript files, web fonts, and incorporates several layout components. The primary language for this template is set to French (`lang="fr"`).

---

## HTML Structure

The document is structured into the following main parts:

-   **`<head>` Section**: Contains meta tags, title, favicon, fonts, and links to CSS.
-   **`<body>` Section**: Comprises the main content area which includes various included Blade components like cookies banner, accessibility options, a navigation bar, and a footer.

### Key Sections and Tags:

-   **Meta Tags**: Important for responsiveness and security tokens.
-   **Favicon**: Link to an external favicon image.
-   **Fonts**: Uses custom fonts from `fonts.bunny.net`.
-   **Vite**: A tool for managing CSS and JS assets.
-   **Layout Components**: Including `cookies`, `accessibility`, `navbar`, `header`, and `footer`.

```html
<link
    rel="shortcut icon"
    href="{{ asset('img/favicon.jpg') }}"
    type="image/x-icon"
/>
<link
    href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
    rel="stylesheet"
/>
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

---

## CSS and JavaScript Inclusions

-   **CSS**: Managed through Laravel Vite, pointing to `resources/css/app.css`.
-   **JavaScript**: Also managed by Vite, pointing to `resources/js/app.js`.

These include the primary styling and functionality required for the web application.

---

## Functional Components

Several functional components are included:

1. **Cookies Banner**: Managed by `@include('layouts.cookies')`.
1. **Accessibility Features**: Included via `@include('layouts.accessibility')`.
1. **Navigation Bar**: Inserted with `@include('layouts.navbar')`.
1. **Header**: Brought in through `@include('layouts.header')`.
1. **Footer**: Added with `@include('layouts.footer')`.

These components are structured to enhance the user experience by providing easy navigation, accessibility options, and informing about cookie usage.

---

## JavaScript Functionality

JavaScript is used for managing cookie consent:

-   **Cookie Consent Handling**: It checks the `localStorage` for cookie preferences (accepted/refused) and hides or shows content accordingly.
-   **Event Handlers**: Attached to accept and refuse buttons for cookies consent.

```javascript
const acceptbutton = document.querySelector('#acceptbutton');
...
localStorage.setItem('cookies', 'accepted');
...
localStorage.setItem('cookies', 'refused');
...
if (localStorage.getItem('cookies') == 'accepted'){
  ...
}
```

This ensures that the website complies with regulations regarding cookies and user consent.

---

In conclusion, `home.blade.php` is a well-structured Blade template for the main layout of a Laravel application, incorporating modern web practices and user interface components to enhance the overall user experience.

# Migration Documentation: Add Columns to Users Table

This documentation outlines the purpose and functionality of the PHP migration file named `2023_11_09_163232_add_columns_to_users_table.php`. This migration adds new columns to the `users` table within a Laravel application's database. It is designed to be used with the Laravel Framework, leveraging Eloquent ORM for database operations.

## Overview

The migration performs two primary operations:

1. **Adding Columns**: It adds three new foreign key columns to the `users` table. These columns are intended to create relationships with other tables.
1. **Removing Columns**: It cleanly removes the columns and their associated foreign key constraints if the migration is rolled back.

## Details of Operations

Below is a detailed explanation of what each part of the migration does:

### Up Method

When the migration is applied using the `php artisan migrate` command, the `up` method is executed. Here's what happens:

1. **Columns Added**:

    `civilite_id`: Nullable foreign key, likely linking to a `civilites` table.

    `parcours_id`: Nullable foreign key, probably connecting to a `parcours` table.

    `diplome_id`: Nullable foreign key, potentially linking to a `diplomes` table.

Each of these columns is set as a foreign ID, which implies they are constrained by the primary keys of their respective referenced tables. Being nullable indicates that it is not mandatory for a user to have associated `civilite`, `parcours`, or `diplome` records.

```php
Schema::table('users', function (Blueprint $table) {
    $table->foreignId('civilite_id')->nullable()->constrained();
    $table->foreignId('parcours_id')->nullable()->constrained();
    $table->foreignId('diplome_id')->nullable()->constrained();
});
```

### Down Method

The `down` method serves to reverse whatever the `up` method does. In this case, if the migration is rolled back using the `php artisan migrate:rollback` command, here's what occurs:

1. **Constraints Removed**: First, it drops the foreign key constraints to avoid errors.
1. **Columns Removed**: Next, it removes the `civilite_id`, `parcours_id`, and `diplome_id` columns from the `users` table.

```php
Schema::table('users', function (Blueprint $table) {
    $table->dropForeign(['civilite_id']);
    $table->dropForeign(['parcours_id']);
    $table->dropForeign(['diplome_id']);
    $table->dropColumn('civilite_id');
    $table->dropColumn('parcours_id');
    $table->dropColumn('diplome_id');
});
```

## Usage

To apply this migration and add the new columns to your `users` table, run:

```bash
php artisan migrate
```

To undo the migration, run:

```bash
php artisan migrate:rollback
```

## Conclusion

This migration is a simple yet powerful example of how Laravel can efficiently handle database schema changes. By adding these foreign key columns, it extends the `users` table's functionality, allowing for more complex data relationships and queries. Remember to have the referenced tables (`civilites`, `parcours`, `diplomes`) created before applying this migration to avoid any foreign key constraint errors.

# Documentation: Creating the Users Table in Laravel

This documentation explains the purpose and functionality of a Laravel migration file named `2014_10_12_000000_create_users_table.php`. Migrations are like version control for your database, allowing you to easily modify and share the application's database schema. The `users` table is fundamental for most web applications, storing user information.

## Overview

-   **Filename**: `2014_10_12_000000_create_users_table.php`
-   **Purpose**: To create the `users` table in the database.
-   **Framework**: Laravel (PHP)

## Migration Structure

This migration file defines two primary methods:

1. **`up()` Method**: Used to add new tables, columns, or indexes to the database.
1. **`down()` Method**: Used to reverse the operations performed by the `up()` method.

### The `up()` Method

When the migration is executed, the `up()` method is called to create the `users` table with the following columns:

|       Column        |    Type     |                            Description                             |
| :-----------------: | :---------: | :----------------------------------------------------------------: |
|        `id`         | Big Integer |                 A unique identifier for the user.                  |
|       `name`        |   String    |                       The name of the user.                        |
|       `email`       |   String    |               The email of the user. Must be unique.               |
| `email_verified_at` |  Timestamp  |         Nullable. Stores the time the email was verified.          |
|     `password`      |   String    |                  The hashed password of the user.                  |
|   `rememberToken`   |   String    |           Used by Laravel to remember the user session.            |
|    `timestamps`     | Timestamps  | Laravel's automatic time stamps for `created_at` and `updated_at`. |

The **creation code** for the table is as follows:

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

### The `down()` Method

The `down()` method reverses the migration, deleting the `users` table if it exists:

```php
Schema::dropIfExists('users');
```

## Execution

-   To **create** the table, run the migration with the following Artisan command:
    ```shell
    php artisan migrate
    ```
-   To **rollback** this migration, use:
    ```shell
    php artisan migrate:rollback
    ```

## :bulb: Note

-   It's crucial to have a robust database design, particularly for the `users` table, as it often interacts with many parts of a Laravel application.
-   Ensure your database connection settings are correctly configured in your `.env` file before running migrations.

This migration file is a foundational part of setting up authentication within a Laravel application, facilitating user registration, authentication, and management.

# `app.php` Configuration Documentation

The `app.php` file is a crucial part of a Laravel application. It contains an array of configurations that dictate how the application behaves in various environments, how it handles languages, time zones, service providers, and much more. Below is a detailed breakdown of the configurations set within `app.php`.

---

## Table of Contents

-   [Application Name](#application-name)
-   [Application Environment](#application-environment)
-   [Application Debug Mode](#application-debug-mode)
-   [Application URL and Asset URL](#application-url-and-asset-url)
-   [Application Timezone](#application-timezone)
-   [Application Locale Configuration](#application-locale-configuration)
-   [Encryption Key and Cipher](#encryption-key-and-cipher)
-   [Maintenance Mode Driver](#maintenance-mode-driver)
-   [Autoloaded Service Providers](#autoloaded-service-providers)
-   [Class Aliases](#class-aliases)

### Application Name

|    <h3><h3><h3>Key</h3></h3></h3>     |                                                   <h3><h3><h3>Description</h3></h3></h3>                                                    |
| :-----------------------------------: | :-----------------------------------------------------------------------------------------------------------------------------------------: |
|  <h3><h3><h3>`locale`</h3></h3></h3>  | <h3><h3><h3>Initially set to `fr`, but overridden later to `en`. Determines the default language/locale for the application.</h3></h3></h3> |
| <h3><h3><h3>`bg-dark`</h3></h3></h3>  |                <h3><h3><h3>Background image in dark mode, fetched from environment variable `BG_DARK_IMAGE`.</h3></h3></h3>                 |
| <h3><h3><h3>`bg-light`</h3></h3></h3> |               <h3><h3><h3>Background image in light mode, fetched from environment variable `BG_LIGHT_IMAGE`.</h3></h3></h3>                |
|   <h3><h3><h3>`name`</h3></h3></h3>   |               <h3><h3><h3>The name of the application, defaulting to `Laravel` if not set in the `.env` file.</h3></h3></h3>                |
|  <h3><h3><h3>`files`</h3></h3></h3>   |                                <h3><h3><h3>Specifies the storage path for framework sessions.</h3></h3></h3>                                |

###

###

###

### Application Environment

|  <h3><h3><h3>Key</h3></h3></h3>  |                                                         <h3><h3><h3>Description</h3></h3></h3>                                                         |
| :------------------------------: | :----------------------------------------------------------------------------------------------------------------------------------------------------: |
| <h3><h3><h3>`env`</h3></h3></h3> | <h3><h3><h3>Determines the application's environment (e.g., production, development), defaulting to `production` if not explicitly set.</h3></h3></h3> |

###

###

###

### Application Debug Mode

|   <h3><h3><h3>Key</h3></h3></h3>   |                                                             <h3><h3><h3>Description</h3></h3></h3>                                                             |
| :--------------------------------: | :------------------------------------------------------------------------------------------------------------------------------------------------------------: |
| <h3><h3><h3>`debug`</h3></h3></h3> | <h3><h3><h3>When enabled, displays detailed error messages with stack traces. Defaults to `false` unless `APP_DEBUG` is set in the `.env` file.</h3></h3></h3> |

###

###

###

### Application URL and Asset URL

|     <h3><h3><h3>Key</h3></h3></h3>     |                                               <h3><h3><h3>Description</h3></h3></h3>                                               |
| :------------------------------------: | :--------------------------------------------------------------------------------------------------------------------------------: |
|    <h3><h3><h3>`url`</h3></h3></h3>    | <h3><h3><h3>The base URL of the application, used by the Artisan command line tool. Defaults to `http://localhost`.</h3></h3></h3> |
| <h3><h3><h3>`asset_url`</h3></h3></h3> |                                  <h3><h3><h3>Optional base URL for serving assets.</h3></h3></h3>                                  |

###

###

###

### Application Timezone

|    <h3><h3><h3>Key</h3></h3></h3>     |                                                  <h3><h3><h3>Description</h3></h3></h3>                                                   |
| :-----------------------------------: | :---------------------------------------------------------------------------------------------------------------------------------------: |
| <h3><h3><h3>`timezone`</h3></h3></h3> | <h3><h3><h3>The default timezone for the application, used by PHP's date and date-time functions. Set to `UTC` by default.</h3></h3></h3> |

###

###

###

### Application Locale Configuration

|        <h3><h3><h3>Key</h3></h3></h3>        |                                    <h3><h3><h3>Description</h3></h3></h3>                                    |
| :------------------------------------------: | :----------------------------------------------------------------------------------------------------------: |
|     <h3><h3><h3>`locale`</h3></h3></h3>      | <h3><h3><h3>The default locale for translation services, overwritten to `en` in the document.</h3></h3></h3> |
| <h3><h3><h3>`fallback_locale`</h3></h3></h3> |       <h3><h3><h3>The locale to use when the current one is not available, set to `en`.</h3></h3></h3>       |
|  <h3><h3><h3>`faker_locale`</h3></h3></h3>   |    <h3><h3><h3>Locale used by the Faker library for generating fake data, set to `en_US`.</h3></h3></h3>     |

###

###

###

### Encryption Key and Cipher

|   <h3><h3><h3>Key</h3></h3></h3>    |                                                              <h3><h3><h3>Description</h3></h3></h3>                                                               |
| :---------------------------------: | :---------------------------------------------------------------------------------------------------------------------------------------------------------------: |
|  <h3><h3><h3>`key`</h3></h3></h3>   | <h3><h3><h3>A random, 32-character string used for encrypted strings. It's crucial for security and should be set before deploying an application.</h3></h3></h3> |
| <h3><h3><h3>`cipher`</h3></h3></h3> |                                   <h3><h3><h3>Determines the encryption cipher to be used, set to `AES-256-CBC`.</h3></h3></h3>                                   |

###

###

###

### Maintenance Mode Driver

|      <h3><h3><h3>Key</h3></h3></h3>      |                                                        <h3><h3><h3>Description</h3></h3></h3>                                                         |
| :--------------------------------------: | :---------------------------------------------------------------------------------------------------------------------------------------------------: |
| <h3><h3><h3>`maintenance`</h3></h3></h3> | <h3><h3><h3>Configuration for determining and managing the application's maintenance mode status. Defaults to using the "file" driver.</h3></h3></h3> |

###

###

###

### Autoloaded Service Providers

|     <h3><h3><h3>Key</h3></h3></h3>     |                                                                          <h3><h3><h3>Description</h3></h3></h3>                                                                          |
| :------------------------------------: | :--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------: |
| <h3><h3><h3>`providers`</h3></h3></h3> | <h3><h3><h3>An array of service providers that will be automatically loaded upon the application's request. This includes both package and application service providers.</h3></h3></h3> |

###

###

###

### Class Aliases

|    <h3><h3><h3>Key</h3></h3></h3>    |                                                             <h3><h3><h3>Description</h3></h3></h3>                                                              |
| :----------------------------------: | :-------------------------------------------------------------------------------------------------------------------------------------------------------------: |
|   <h3><h3><h3>`log`</h3></h3></h3>   |                                 <h3><h3><h3>Specifies the log channel, defaults to `stack` if not set in `.env`.</h3></h3></h3>                                 |
| <h3><h3><h3>`aliases`</h3></h3></h3> | <h3><h3><h3>An array of class aliases that are registered when the application starts. Includes a lazy loading feature for improved performance.</h3></h3></h3> |

###

###

###

---

This configuration file is vital for setting up and customizing the Laravel application to meet specific requirements and preferences, ranging from basic app settings like locale and timezone to more advanced configurations such as service providers and class aliases.

# Documentation for `ade.php`

## Overview

The `ade.php` file is a configuration file used within a PHP project. Its primary purpose is to define settings related to authentication, proxy configuration, and server details. These settings are crucial for establishing connections or performing operations that require specific configurations, such as accessing external services or APIs securely.

## Configuration Details

Below is a detailed explanation of each configuration setting present in the `ade.php` file. These settings are fetched using the `env()` function, which retrieves the value from the environment file (`.env`). This approach helps in keeping sensitive information out of the source code and makes the application more secure and configurable.

|       Key        |                        Description                        |   Example Value    |
| :--------------: | :-------------------------------------------------------: | :----------------: |
|     `login`      |         The login credential for authentication.          |    `your_login`    |
|    `password`    |             The password for authentication.              |  `your_password`   |
|  `proxy_login`   |     Login credential for the proxy server (if used).      |    `proxy_user`    |
| `proxy_password` |         Password for the proxy server (if used).          |  `proxy_password`  |
|   `proxy_url`    |          The URL of the proxy server (if used).           | `http://proxy.com` |
|    `protocol`    |            The protocol used for connections.             |      `https`       |
|     `server`     |             The server address to connect to.             |    `server.com`    |
|    `useProxy`    | A boolean value indicating whether to use a proxy server. |    `true/false`    |

## Usage Example

In a typical use case, these configurations can be accessed within the application to set up connections. Here's an example snippet demonstrating how to use these configurations:

```php
$config = include 'ade.php';

// Example usage
$login = $config['login'];
$password = $config['password'];
$useProxy = $config['useProxy'];

if ($useProxy) {
    $proxyUrl = $config['proxy_url'];
    // Setup proxy configurations
}

// Proceed with your logic here
```

## 🛠️ How to Set Configuration Values

To set up or modify the configuration values for your project, you'll need to edit the `.env` file located at the root of your project. Here's an example of how the `.env` file entries might look:

```plaintext
ADE_LOGIN=your_login
ADE_PASSWORD=your_password
ADE_PROXY_LOGIN=proxy_user
ADE_PROXY_PASSWORD=proxy_password
ADE_PROXY_URL=http://proxy.com
ADE_PROTOCOL=https
ADE_SERVER=server.com
ADE_USE_PROXY=false
```

## Summary

The `ade.php` file is a critical configuration file that facilitates secure and flexible connections within a PHP project. It leverages environment variables to manage sensitive information effectively, ensuring that the application can adapt to various environments (development, testing, production) without code changes.

By properly configuring the `.env` file and utilizing the `ade.php` settings, developers can ensure that their application communicates securely and efficiently with external services or APIs.

# Documentation for `ade.php`

## Overview

The `ade.php` file is a configuration file used within a PHP project. Its primary purpose is to define settings related to authentication, proxy configuration, and server details. These settings are crucial for establishing connections or performing operations that require specific configurations, such as accessing external services or APIs securely.

## Configuration Details

Below is a detailed explanation of each configuration setting present in the `ade.php` file. These settings are fetched using the `env()` function, which retrieves the value from the environment file (`.env`). This approach helps in keeping sensitive information out of the source code and makes the application more secure and configurable.

|       Key        |                        Description                        |   Example Value    |
| :--------------: | :-------------------------------------------------------: | :----------------: |
|     `login`      |         The login credential for authentication.          |    `your_login`    |
|    `password`    |             The password for authentication.              |  `your_password`   |
|  `proxy_login`   |     Login credential for the proxy server (if used).      |    `proxy_user`    |
| `proxy_password` |         Password for the proxy server (if used).          |  `proxy_password`  |
|   `proxy_url`    |          The URL of the proxy server (if used).           | `http://proxy.com` |
|    `protocol`    |            The protocol used for connections.             |      `https`       |
|     `server`     |             The server address to connect to.             |    `server.com`    |
|    `useProxy`    | A boolean value indicating whether to use a proxy server. |    `true/false`    |

## Usage Example

In a typical use case, these configurations can be accessed within the application to set up connections. Here's an example snippet demonstrating how to use these configurations:

```php
$config = include 'ade.php';

// Example usage
$login = $config['login'];
$password = $config['password'];
$useProxy = $config['useProxy'];

if ($useProxy) {
    $proxyUrl = $config['proxy_url'];
    // Setup proxy configurations
}

// Proceed with your logic here
```

## 🛠️ How to Set Configuration Values

To set up or modify the configuration values for your project, you'll need to edit the `.env` file located at the root of your project. Here's an example of how the `.env` file entries might look:

```plaintext
ADE_LOGIN=your_login
ADE_PASSWORD=your_password
ADE_PROXY_LOGIN=proxy_user
ADE_PROXY_PASSWORD=proxy_password
ADE_PROXY_URL=http://proxy.com
ADE_PROTOCOL=https
ADE_SERVER=server.com
ADE_USE_PROXY=false
```

## Summary

The `ade.php` file is a critical configuration file that facilitates secure and flexible connections within a PHP project. It leverages environment variables to manage sensitive information effectively, ensuring that the application can adapt to various environments (development, testing, production) without code changes.

By properly configuring the `.env` file and utilizing the `ade.php` settings, developers can ensure that their application communicates securely and efficiently with external services or APIs.

# `PermsPolicy.php` Documentation

The `PermsPolicy.php` file is a crucial component within the Laravel application, specifically within the `App\Policies` namespace. This file defines the `PermsPolicy` class, which is responsible for authorizing user actions based on their roles. It leverages Laravel's authorization capabilities to determine if a user has the necessary permissions to perform certain actions, such as viewing specific pages or functionalities within the application.

## Features

-   Utilizes the `HandlesAuthorization` trait for integrating authorization capabilities.
-   Defines multiple methods for checking user permissions based on their role and other attributes.

## Methods Overview

|        <h2><h2><h2>Method</h2></h2></h2>        |                           <h2><h2><h2>Description</h2></h2></h2>                            |
| :---------------------------------------------: | :-----------------------------------------------------------------------------------------: |
|   <h2><h2><h2>`viewImportForm`</h2></h2></h2>   |         <h2><h2><h2>Determines if the user can view the import form.</h2></h2></h2>         |
|      <h2><h2><h2>`viewHome`</h2></h2></h2>      |         <h2><h2><h2>Checks if the user has access to the home page.</h2></h2></h2>          |
|    <h2><h2><h2>`viewEDTHome`</h2></h2></h2>     |    <h2><h2><h2>Authorizes access to the EDT home page for specific roles.</h2></h2></h2>    |
|    <h2><h2><h2>`viewAbsences`</h2></h2></h2>    |              <h2><h2><h2>Checks if the user can view absences.</h2></h2></h2>               |
|     <h2><h2><h2>`viewPromo`</h2></h2></h2>      |       <h2><h2><h2>Authorizes viewing of promotions for certain roles.</h2></h2></h2>        |
|     <h2><h2><h2>`viewGroup`</h2></h2></h2>      |             <h2><h2><h2>Determines if the user can view groups.</h2></h2></h2>              |
|     <h2><h2><h2>`viewTrombi`</h2></h2></h2>     |       <h2><h2><h2>Authorizes viewing of the trombi for specific roles.</h2></h2></h2>       |
|  <h2><h2><h2>`viewAllAbsences`</h2></h2></h2>   |            <h2><h2><h2>Checks if the user can view all absences.</h2></h2></h2>             |
|    <h2><h2><h2>`viewGroupNav`</h2></h2></h2>    |      <h2><h2><h2>Determines if the user can view the group navigation.</h2></h2></h2>       |
|    <h2><h2><h2>`viewPromoNav`</h2></h2></h2>    |      <h2><h2><h2>Checks if the user can view the promotion navigation.</h2></h2></h2>       |
|  <h2><h2><h2>`viewAbsencesNav`</h2></h2></h2>   | <h2><h2><h2>Authorizes viewing of the absences navigation for certain roles.</h2></h2></h2> |
|   <h2><h2><h2>`viewTrombiNav`</h2></h2></h2>    |      <h2><h2><h2>Determines if the user can view the trombi navigation.</h2></h2></h2>      |
|     <h2><h2><h2>`viewQRCode`</h2></h2></h2>     |              <h2><h2><h2>Checks if the user can view QR codes.</h2></h2></h2>               |
| <h2><h2><h2>`viewJustifyAbsence`</h2></h2></h2> |   <h2><h2><h2>Authorizes the justification of absences for certain roles.</h2></h2></h2>    |

##

##

##

## Usage

-   **Role-Based Access Control (RBAC):** This policy class uses the user's role to control access to various parts of the application. For example, only users with the role of 'admin' can view the import form.
-   **Conditional Access:** Some actions, like viewing the home page, depend on specific conditions other than the role, such as the presence of a diploma code (`code_diplome`).

### Example Usage

Checking if a user can view the import form:

```php
$user = User::find(1); // Assuming the user exists
$permsPolicy = new PermsPolicy();

if ($permsPolicy->viewImportForm($user)) {
    // Logic for authorized access
} else {
    // Logic for denied access
}
```

## Conclusion

The `PermsPolicy.php` file is a powerful tool for managing user permissions within a Laravel application. By defining specific methods for different actions and relying on user attributes, it provides a flexible way to implement role-based access control and ensure that users can only perform actions they are authorized for. 🛡️🔑

---

# User Model Documentation

The `User.php` file is a part of the `App\Models` namespace, which indicates it's a model class typically used in Laravel applications for interacting with the database specifically regarding user data. This class extends `Illuminate\Foundation\Auth\User` making it an authenticatable model suitable for handling authentication.

## Features

-   **Authenticatable**: Inherits properties and methods for authentication.
-   **Mass Assignable Attributes**: Defines which attributes can be mass-assigned.
-   **Hidden Attributes**: Specifies attributes that should be excluded from the model's JSON form.
-   **Attribute Casting**: Automatically casts attributes to the specified type.
-   **Relationships**: Defines relationships to other models.

Below is a detailed breakdown of its components and functionalities:

### Traits Used

|     <h3><h3><h3>Trait</h3></h3></h3>      |                          <h3><h3><h3>Purpose</h3></h3></h3>                           |
| :---------------------------------------: | :-----------------------------------------------------------------------------------: |
| <h3><h3><h3>`HasApiTokens`</h3></h3></h3> |   <h3><h3><h3>Enables Laravel Sanctum's token-based authentication.</h3></h3></h3>    |
|  <h3><h3><h3>`HasFactory`</h3></h3></h3>  | <h3><h3><h3>Facilitates the generation of model instances for testing.</h3></h3></h3> |
|  <h3><h3><h3>`Notifiable`</h3></h3></h3>  |          <h3><h3><h3>Allows the model to send notifications.</h3></h3></h3>           |

###

###

###

### Fillable Attributes

The `$fillable` property contains an array of attributes that are allowed to be mass-assigned. This is a security feature to prevent mass assignment vulnerabilities.

```php
protected $fillable = [
    'name', 'email', 'password', 'group_id', 'role',
    'prenom', 'nom', 'image', 'statut', 'diplome_id',
    'parcour_id', 'civilite_id', 'code_diplome',
];
```

### Hidden Attributes

The `$hidden` property defines which attributes should be hidden from the model's array and JSON output. Typically used for sensitive information like passwords.

```php
protected $hidden = [
    'password', 'remember_token',
];
```

### Casts

The `$casts` property allows attributes to be automatically cast to a specified type when set or retrieved from the database.

```php
protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
];
```

### Relationships

-   **Group Relationship**: A user belongs to a group.
-   **Diplome Relationship**: A user has one diplome (degree).
-   **Parcour Relationship**: A user is part of a parcour (curriculum).
-   **Civilite Relationship**: A user has one civilite (title/gender).
-   **Absences Relationship**: A user can have many absences.
-   **Retards Relationship**: A user can have many retards (delays).

```php
public function group() { return $this->belongsTo(Group::class); }
public function diplome() { return $this->belongsTo(Diplome::class); }
public function parcour() { return $this->belongsTo(Parcour::class); }
public function civilite() { return $this->belongsTo(Civilite::class); }
public function absences() { return $this->hasMany(Absence::class); }
public function retards() { return $this->hasMany(Retard::class); }
```

### Summary

The `User` model is a key part of the application, enabling the management of user data including their authentication, personal information, and relationships with other parts of the application like groups, diplomas, and absences. It utilizes Laravel's features such as Eloquent ORM for database interaction, mass assignment protection, attribute casting, and more to efficiently handle user-related data securely and effectively.

# Documentation for `Retard.php`

This documentation provides an overview of the `Retard.php` file, its purpose, and its functionality within an application. The `Retard.php` file is a part of the Model layer in a Laravel application, which adheres to the MVC (Model-View-Controller) software design pattern.

## 📄 File Overview

The `Retard.php` file defines a model in a Laravel application. The model's name is `Retard`, which suggests it is related to tracking or managing instances of lateness or delays within the context it is used (e.g., a school or workplace attendance system).

### Namespace and Imports

-   **Namespace:** `App\Models`
    -   This indicates that the `Retard` class is part of the `Models` directory in the Laravel application structure, following PSR-4 autoloading standards.
-   **Imports:**
    -   `Illuminate\Database\Eloquent\Factories\HasFactory`
    -   `Illuminate\Database\Eloquent\Model`
    -   These imports allow the `Retard` model to utilize Eloquent ORM features for database operations and factory methods for creating instances of the model during testing.

### Class Definition

-   **Class Name:** `Retard`
-   **Extends:** `Model`
    -   This means that `Retard` is a Laravel Eloquent model, inheriting methods and properties from Eloquent's base `Model` class.
-   **Traits:**
    -   `HasFactory`
        -   Including this trait allows the model to leverage the Laravel factory pattern for database seeding and testing purposes.

### Properties

-   **$fillable**
    -   Type: Array
    -   Purpose: To specify which attributes of the model are mass assignable. This is a security feature of Laravel to prevent mass assignment vulnerabilities.
    -   Fields:
        -   `cours` - Likely represents the course or class associated with the instance of lateness.
        -   `date` - The date on which the lateness occurred.
        -   `time_arrived` - The time the individual arrived, indicating how late they were.
        -   `user_id` - A reference to the user who was late. Presumably, this ties a `Retard` instance to a specific user in the system.

## 🛠️ Purpose and Usage

The `Retard` model appears to serve the purpose of tracking instances of lateness or delays within an application. It could be part of a larger system designed to manage attendance, such as in educational institutions or workplaces.

### Usage Example

Creating a new instance of `Retard` could be as simple as:

```php
$retard = new App\Models\Retard([
    'cours' => 'Math 101',
    'date' => '2023-04-01',
    'time_arrived' => '09:15:00',
    'user_id' => 1,
]);

$retard->save();
```

This example would create a new record indicating that the user with `user_id` 1 was late for `Math 101` on April 1st, 2023, arriving at 9:15 AM.

## 📚 Conclusion

The `Retard.php` model is a crucial part of an application's model layer, responsible for managing data related to lateness or delays. By leveraging Laravel's Eloquent ORM and security features like mass assignment protection, it provides a robust and secure way to handle this specific type of data within the application.

# Parcour Model Documentation

The `Parcour.php` file is a part of the Model layer in the Laravel framework, specifically within an application's **App\Models** namespace. This model is designed to interact with a database table that corresponds to its name in a conventional manner, which, in Laravel, is typically the plural form of the model name. Therefore, the `Parcour` model is expected to interact with the `parcours` table in the database.

## Features and Usage

The `Parcour` model incorporates several functionalities provided by Laravel, aiding in database operations related to the `parcours` table. Below is a detailed explanation of its features and how it's structured.

### Namespace

```php
namespace App\Models;
```

The model resides in the `App\Models` namespace, making it a part of the application's model layer. This organization assists in separating the model's functionality from the rest of the application, adhering to a clean architecture.

### Dependencies

```php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
```

The `Parcour` model uses the `Model` class from Laravel's Eloquent ORM (Object-Relational Mapping) for database interactions and the `HasFactory` trait for factory-based seeding, which is useful in testing and seeding the database with fake data.

### The Parcour Class

```php
class Parcour extends Model {
    use HasFactory;

    protected $fillable = ['label'];
}
```

-   **Extends Model**: By extending Laravel's `Model` class, `Parcour` inherits methods and properties that allow it to perform various ORM functionalities, such as querying the database, inserting records, updating, and deleting.
-   **HasFactory Trait**: This trait enables the model to utilize the factory pattern for generating test data. It's particularly useful during development and testing phases for creating multiple database records without manually inserting them.
-   **Fillable Property**: The `$fillable` property is an array that specifies which attributes should be assignable in bulk. In this case, `['label']` indicates that only the `label` attribute can be mass-assigned. This is a security feature that prevents mass-assignment vulnerabilities.

## Conclusion

The `Parcour` model is a simple yet integral part of the application, designed to interact with the `parcours` table in the database. It leverages Laravel's Eloquent ORM for database operations, ensuring a fluent and secure way to manage the application's data. Through the use of the `HasFactory` trait, it also simplifies the process of generating test data, making it a valuable tool for development and testing.

# Group Model Documentation

The `Group.php` file is part of the Model layer in a Laravel application, under the `App\Models` namespace. It represents the `Group` entity, which is likely related to managing groups within the application. This documentation provides a detailed overview of its structure and functionality.

## Overview

The `Group` model is designed to interact with a database table (presumably named `groups`), handling data related to groups within the application. It leverages Laravel's Eloquent ORM for data representation and manipulation.

### Namespace

```php
App\Models
```

This indicates that the `Group` model resides in the `Models` directory under the `App` namespace, adhering to PSR-4 autoloading standards.

### Traits

-   **`HasFactory`**: This trait, imported from `Illuminate\Database\Eloquent\Factories\HasFactory`, enables the model to utilize the factory pattern for database seeding and testing purposes.

### Properties

-   **`$fillable`**: An array that specifies which attributes should be assignable in bulk. In this model, the `label` attribute is fillable.

### Relationships

-   **`users()`**: This method defines a one-to-many relationship between a group and its users. It implies that each group can have multiple users associated with it.

## Code Structure

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['label'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
```

## Key Functionalities

-   **Mass Assignment Protection**: The `fillable` property ensures that only the `label` attribute can be mass-assigned, protecting against mass-assignment vulnerabilities.
-   **Relationship to Users**: Through the `users` method, the `Group` model defines its relationship with the `User` model. This is a fundamental aspect of the model, indicating that the application likely involves functionality related to grouping users.

## Usage

In the context of an application, the `Group` model could be used in various scenarios, such as:

-   Creating new groups with specific labels.
-   Associating users with groups, and retrieving all users belonging to a particular group.
-   Utilizing factories for generating test data related to groups.

This model is a foundational piece for features that involve grouping mechanisms within the application, enabling efficient data handling and manipulation related to groups and their associated users.

# Diplome Model Documentation

The `Diplome.php` file is part of the **Model layer** in a Laravel application, located in the `App\Models` namespace. Models in Laravel are primarily used for interacting with corresponding tables in the database. The `Diplome` model represents a specific table in the database that stores information about various diplomas.

## Features of the `Diplome` Model

-   **Namespace:** It belongs to the `App\Models` namespace, making it part of the Models directory in a Laravel project.
-   **Dependencies:** It uses the `HasFactory` trait from the `Illuminate\Database\Eloquent\Factories` namespace. This trait enables the model to work with factories for seeding data to the database for testing purposes.
-   **Inheritance:** It extends the `Model` class from `Illuminate\Database\Eloquent`, which provides it with the methods and properties to interact with the database.
-   **Fillable Attributes:** The model has protected property `$fillable` which specifies the attributes that are mass assignable. This is a security feature in Laravel to prevent mass-assignment vulnerabilities.

## Attributes

The `Diplome` model has the following attributes that can be mass-assigned:

| Attribute |              Description               |
| :-------: | :------------------------------------: |
|  `title`  |   The title or name of the diploma.    |
|  `annee`  |   The year the diploma was awarded.    |
|  `code`   | A unique code identifying the diploma. |

## Example Usage of `Diplome` Model

```php
// Creating a new Diplome instance and saving it to the database
$dip = new \App\Models\Diplome([
    'title' => 'Bachelor of Science',
    'annee' => '2022',
    'code' => 'BSC2022'
]);
$dip->save();

// Alternatively, using the create method which is enabled by the HasFactory trait
\App\Models\Diplome::create([
    'title' => 'Master of Science',
    'annee' => '2023',
    'code' => 'MSC2023'
]);
```

In the examples above, a new `Diplome` instance is created and saved to the database with the specified attributes: `title`, `annee`, and `code`. The `save()` method is used in the first example, while the `create()` method, which requires the `HasFactory` trait, is used in the second example.

## Conclusion

The `Diplome` model plays a crucial role in managing the data related to diplomas in the application. By defining the `$fillable` attributes, it ensures that only specific columns in the database table can be updated through mass assignment, enhancing the security of the application.

# Civilite Model Documentation

The `Civilite` class is a PHP model that is part of the Laravel framework, specifically designed for use within a Laravel application. This document aims to provide a comprehensive overview of its purpose, structure, and functionality.

## Overview

`Civilite` is a model class that represents a specific data structure within a Laravel application, tailored to interact with a corresponding database table. This model is primarily focused on handling data related to **civility** entities, which could represent titles or forms of address (such as Mr., Mrs., Dr., etc.).

## Key Features

-   **Laravel Eloquent**: Inherits features from Laravel's Eloquent ORM for elegant and efficient database operations.
-   **Fillable Property**: Safeguards against mass assignment vulnerabilities for specified attributes.

## Code Structure

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civilite extends Model
{
    use HasFactory;

    protected $fillable = ['label'];
}
```

### Components

-   **Namespace**: `App\Models` - Indicates the location of the `Civilite` class within the application's directory structure, following PSR-4 autoloading standards.
-   **Dependencies**:
    -   `HasFactory` - Facilitates the use of the factory pattern for database testing and seeding.
    -   `Model` - The base Eloquent model class that `Civilite` extends from, providing ORM functionalities.
-   **Traits**:
    -   `HasFactory` - Incorporates factory-based testing capabilities into the `Civilite` model.
-   **Properties**:
    -   `$fillable` - An array containing the names of the attributes that are allowed to be mass-assigned. For the `Civilite` model, the `label` attribute is fillable.

## Usage

The `Civilite` model is primarily used to interact with the database table that stores civility titles or labels. Its structure allows developers to perform a wide range of database operations, such as creating, reading, updating, and deleting records related to civility entities.

### Example Scenario

In an application that requires users to select a form of address upon registration, the `Civilite` model could be used to fetch and display the available options from the database.

## Conclusion

The `Civilite` class is a crucial component within a Laravel application that requires management of civility-related data. With its straightforward structure and the powerful features provided by Laravel's Eloquent ORM, it offers an efficient and secure way to interact with the corresponding database table.

---

This documentation covers the basics of the `Civilite` model. For further details on working with Eloquent models and Laravel in general, refer to the official Laravel documentation.

# Documentation for `Appel.php`

The `Appel.php` file is a model class used in the Laravel framework, which is a popular PHP framework for web development. This documentation provides a comprehensive overview of its functionalities and usage.

## Overview

The `Appel` model represents a specific data structure within the application, typically corresponding to a table in the database. This model is located under the `App\Models` namespace, making it part of the application's model layer, which is responsible for interacting with the database.

## Features and Usage

-   **Namespace**: The model resides in the `App\Models` namespace.
-   **Eloquent ORM**: It leverages Laravel's Eloquent ORM for elegant and efficient database operations.
-   **Mass Assignment Protection**: Utilizes the `$fillable` property to specify which attributes should be assignable in bulk.

### Table: Key Components of `Appel` Model

|     <h3><h3><h3>Component</h3></h3></h3>     |                                             <h3><h3><h3>Description</h3></h3></h3>                                              |
| :------------------------------------------: | :-----------------------------------------------------------------------------------------------------------------------------: |
|     <h3><h3><h3>Namespace</h3></h3></h3>     |                                             <h3><h3><h3>`App\Models`</h3></h3></h3>                                             |
|     <h3><h3><h3>Inherits</h3></h3></h3>      |                      <h3><h3><h3>`Model` class from Laravel, providing ORM functionalities.</h3></h3></h3>                      |
|    <h3><h3><h3>Trait Used</h3></h3></h3>     |     <h3><h3><h3>`HasFactory` - Enables the model to use factories for database seeding and testing purposes.</h3></h3></h3>     |
| <h3><h3><h3>`$fillable` Array</h3></h3></h3> | <h3><h3><h3>Protects against mass assignment vulnerabilities by specifying which attributes are mass assignable.</h3></h3></h3> |

###

###

###

### Code Snippet

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appel extends Model
{
    use HasFactory;

    protected $fillable = ['cours'];
}
```

## 📌 Key Points

-   **Model Name**: `Appel`
-   **Purpose**: Represents a database entity related to 'cours'. The exact nature of 'cours' depends on the application context but could represent courses or classes in an educational application.
-   **Mass Assignment**: This model explicitly allows mass assignment for the `cours` attribute. This enables efficient creation and updates to the `Appel` model instances with respect to the 'cours' field.

## Conclusion

The `Appel.php` file defines a crucial model within the Laravel application. By adhering to best practices such as mass assignment protection and leveraging Eloquent's ORM features, it facilitates robust and secure database interactions, particularly with operations related to 'cours'. This model plays an integral role in managing the application's data layer related to its specific domain.

# Absence Model Documentation

The `Absence.php` file is part of the `App\Models` namespace, which is typically used within Laravel projects. This file defines a model which interacts with a database table (presumably named `absences`, following Laravel's naming conventions). The `Absence` model facilitates operations such as creating, reading, updating, and deleting records related to absences in the application's database.

## 📄 Overview

-   **Namespace:** `App\Models`
-   **Inherits:** `Illuminate\Database\Eloquent\Model`
-   **Traits Used:** `Illuminate\Database\Eloquent\Factories\HasFactory`

## 🚀 Features

-   **Eloquent ORM:** Utilizes Laravel's Eloquent ORM for elegant and efficient database operations.
-   **Mass Assignment Protection:** Utilizes the `$fillable` array to specify which attributes should be mass-assignable, protecting against mass-assignment vulnerabilities.

## 🔑 Properties

The model defines the following attributes as mass-assignable:

|      Attribute       |               Description               |
| :------------------: | :-------------------------------------: |
|       `cours`        |   The course related to the absence.    |
|      `user_id`       |    The ID of the user who is absent.    |
|       `status`       |       The status of the absence.        |
| `justification_file` | File path of the absence justification. |

## 📎 Relationships

### User

-   **Type:** Belongs To
-   **Description:** This relationship indicates that each absence record is associated with a specific user.
-   **Method:** `user()`

## 📚 Usage

### Defining a New Absence

To create a new absence, you would typically instantiate an `Absence` object, set its properties (or use mass assignment), and then save it to the database:

```php
$absence = new App\Models\Absence([
    'cours' => 'Math 101',
    'user_id' => 1,
    'status' => 'pending',
    'justification_file' => '/path/to/justification.pdf',
]);

$absence->save();
```

### Retrieving the Associated User

To get the user associated with an absence, you may access the `user` relationship:

```php
$user = $absence->user;
```

This returns the `User` model instance that is associated with the absence.

## 🌟 Conclusion

The `Absence` model is a crucial part of an application that manages or tracks absences. It allows for easy interaction with the database to perform operations related to absences, such as marking a student as absent, attaching justification files, and linking absences to specific courses and users. By utilizing Laravel's Eloquent ORM, the `Absence` model provides a flexible and powerful way to manage absence data efficiently.

# Documentation for `MyGestscolEmail.php`

## Overview

`MyGestscolEmail.php` is a PHP file that is part of the Laravel framework, specifically designed for handling the creation and customization of an email. It extends the `Mailable` class, which is a core component of Laravel's mailing system, allowing developers to send emails in a more expressive and simple way. This custom mailable class, `MyGestscolEmail`, is used to send emails with specific user details such as name, surname, course of study, group, and password.

## Features

-   **Queueable and Serializes Models**: Implements Laravel's `Queueable` trait and `SerializesModels` trait for efficient email queue handling and model serialization.
-   **Customizable Email Content**: Allows for dynamic setting of user-specific details in the email.
-   **Structured and Readable Code**: Leverages PHP 8's named arguments for more readable method calls.

## How It Works

`MyGestscolEmail` class uses several private properties to store user details and constructs an email with these details. Below is a breakdown of its components:

### Properties

|  <h3><h3><h3>Property</h3></h3></h3>   |  <h3><h3><h3>Type</h3></h3></h3>  |            <h3><h3><h3>Description</h3></h3></h3>             |
| :------------------------------------: | :-------------------------------: | :-----------------------------------------------------------: |
|   <h3><h3><h3>`$nom`</h3></h3></h3>    | <h3><h3><h3>string</h3></h3></h3> |    <h3><h3><h3>Stores the user's last name.</h3></h3></h3>    |
|  <h3><h3><h3>`$prenom`</h3></h3></h3>  | <h3><h3><h3>string</h3></h3></h3> |   <h3><h3><h3>Stores the user's first name.</h3></h3></h3>    |
| <h3><h3><h3>`$parcours`</h3></h3></h3> | <h3><h3><h3>string</h3></h3></h3> | <h3><h3><h3>Stores the user's course of study.</h3></h3></h3> |
|  <h3><h3><h3>`$group`</h3></h3></h3>   | <h3><h3><h3>string</h3></h3></h3> |       <h3><h3><h3>Stores the user group.</h3></h3></h3>       |
| <h3><h3><h3>`$password`</h3></h3></h3> | <h3><h3><h3>string</h3></h3></h3> |    <h3><h3><h3>Stores the user's password.</h3></h3></h3>     |

###

###

###

### Constructor

The `__construct` method initializes the class with user-specific details.

```php
public function __construct($nom, $prenom, $parcours, $group, $password) {
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->parcours = $parcours;
    $this->group = $group;
    $this->password = $password;
}
```

### Building the Email

-   **Envelope**: Sets the subject of the email.

```php
public function envelope(): Envelope {
    return new Envelope(subject: 'My Gestscol Email');
}
```

-   **Content**: Defines the view and data to be used in the email. The view `mail.test-email` should be created to structure the email content.

```php
public function content(): Content {
    return new Content(
        view: 'mail.test-email',
        with: [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'parcours' => $this->parcours,
            'group' => $this->group,
            'password' => $this->password
        ]
    );
}
```

-   **Attachments**: Currently returns an empty array, but it can be modified to include attachments if needed.

```php
public function attachments(): array {
    return [];
}
```

## Usage

To use `MyGestscolEmail`, you need to:

1. **Create the email view**: Ensure that a view exists at `resources/views/mail/test-email.blade.php`.
1. **Send the email**: Use Laravel's mail facade to send the email.

Example:

```php
Mail::to('recipient@example.com')->send(new MyGestscolEmail($nom, $prenom, $parcours, $group, $password));
```

## Conclusion

`MyGestscolEmail` provides a structured and efficient way to send customized emails to users, leveraging Laravel's powerful mailing system. It showcases how to encapsulate user data within an email and hints at how to expand functionality, such as adding attachments. This class is a prime example of how Laravel enables developers to handle common web development tasks with ease and elegance.

# Trombinoscope Documentation

The `Trombinoscope.php` file is a PHP class designed to work within the Laravel framework, leveraging the Livewire package for dynamic component interaction. This class is part of the `App\Livewire` namespace, indicating its role in the Livewire component system for real-time user interface updates without the need for page reloads. The primary functionality of this component is to display a list of users (a trombinoscope) filtered by group and formation criteria.

## Overview

The Trombinoscope component allows users to dynamically filter and view a list of individuals based on their group and formation affiliations within an educational or organizational context. This functionality is particularly useful in environments such as educational institutions or companies with structured group and training programs.

### Key Features

-   **Dynamic Filtering**: Users can filter the trombinoscope view based on group and formation criteria.
-   **Real-Time Updates**: Leveraging Livewire, the component updates the view in real time as filters are applied, enhancing user experience.
-   **Clean Separation of Concerns**: By utilizing a dedicated Livewire component, the logic for the trombinoscope feature is encapsulated, promoting maintainability and scalability.

### Code Structure

```php
<?php

namespace App\Livewire;

use App\Models\Formation;
use App\Models\Group;
use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class Trombinoscope extends Component
{
    public $form = [
        'group' => '',
        'formation' => '',
    ];

    public function render()
    {
        $trombi = User::orderBy('name')
            ->when(!empty($this->form['group']), function (Builder $query) {
                $query->where('group_id', "=", $this->form['group']);
                $query->when(!empty($this->form['formation']), function (Builder $query) {
                    $query->where('formation_id', "=", $this->form['formation']);
                });
            })->get();

        $trombi_group = Group::where('id', $this->form['group'])->get();

        return view('livewire.trombinoscope', [
            'trombi' => $trombi,
            'group' => $trombi_group,
        ]);
    }
}
```

### Key Components

-   **Namespaces and Imports**: The class begins by declaring its namespace (`App\Livewire`) and importing necessary classes (`User`, `Group`, `Formation`, `Component`, and `Builder`).
-   **Class Declaration**: The `Trombinoscope` class extends `Livewire\Component`, indicating it's a Livewire component.
-   **Public Properties**: A public `$form` property is declared to hold filter criteria for the trombinoscope (group and formation).
-   **Render Method**: The `render` method is where the main functionality resides. It fetches and filters users based on the criteria provided in `$form`, then passes the filtered list of users (`$trombi`) and the selected group (`$trombi_group`) to the view named `livewire.trombinoscope`.

### Conclusion

The `Trombinoscope` Livewire component provides an efficient way to dynamically filter and display a list of users based on specific criteria, offering an interactive user experience for browsing user profiles within structured groups and formations. Its implementation within the Laravel and Livewire ecosystem exemplifies modern PHP development practices for building responsive and maintainable web applications.

# `UsersListImport.php` Documentation

The `UsersListImport.php` file is part of an application that handles importing user data into the system from an Excel file. This process is crucial for batch processing and automating the user creation and update process. Below, we delve into the specifics of how this file operates, its dependencies, and its overall functionality within the application.

## Overview

`UsersListImport.php` implements two important interfaces from the Maatwebsite Excel package: `ToCollection` and `WithHeadingRow`. This indicates that the file processes Excel data as a collection, where each row represents a user's data, and it expects the first row of the Excel file to contain headings that map to user attributes.

## Dependencies

The file utilizes several models from the application to interact with the database and other Laravel features for tasks such as hashing passwords and sending emails. Here is a breakdown of its dependencies:

|                        Dependency                        |                      Purpose                       |
| :------------------------------------------------------: | :------------------------------------------------: |
|                     App\Models\User                      |    Represents the user entity in the database.     |
|      App\Models{Civilite, Diplome, Group, Parcour}       | Represents other related entities in the database. |
|              Illuminate\Support\Collection               |   Allows handling of bulk data as a collection.    |
|          Illuminate\Support\Facades{Hash, Mail}          |  Facilitates password hashing and email sending.   |
| Maatwebsite\Excel\Concerns{ToCollection, WithHeadingRow} |       Interfaces for handling Excel imports.       |
|                 App\Mail\MyGestscolEmail                 |  A Mailable class for sending customized emails.   |

## Functionality

### Import Logic

When an Excel file is imported:

1. The file is read row by row.
1. For each row, it checks if a user with the specified email exists.
1. If the user exists, it updates the user's information if there are changes.
1. If the user does not exist, it creates a new user with the information provided, including a randomly generated password.
1. Email functionality is commented out but indicates the ability to send emails to new users with their account details.

### Key Operations

**Existing Users**: Validates if the existing user data matches the imported data. If there are differences, it updates the user's information.

**New Users**: Creates new users with a unique, randomly generated password and assigns them attributes based on the Excel row data.

**Data Validation**: Checks for the presence of required fields before creating new users.

### Email Functionality

Although the email sending logic is commented out, the code provides a foundation for sending welcome emails to new users, including their login details.

## Example Usage

This class could be utilized as part of an administrative dashboard where administrators can batch import users from an Excel file, thereby streamlining the process of user management in the application.

## Conclusion

`UsersListImport.php` simplifies user management by automating the process of importing users from Excel files. It showcases the power of Laravel's ecosystem in handling file imports, database interactions, and even sending emails, making it a valuable part of the application's administrative toolkit.

# UsersExport.php Documentation

The `UsersExport.php` class is part of an application that is likely used for exporting user data into a format that can be handled by Excel or similar spreadsheet software. This class is built using the Laravel framework, leveraging the Maatwebsite Excel package to facilitate the export functionality. Below, you'll find a detailed breakdown of its components and functionalities.

## Overview

-   **Namespace**: `App\Exports`
-   **Dependencies**:
    -   `App\Models\User`: The User model, likely representing user data within the application's database.
    -   `Maatwebsite\Excel\Concerns\FromCollection`: Interface to indicate the export is from a collection.
    -   `Maatwebsite\Excel\Concerns\WithHeadings`: Interface to define custom headings for the Excel sheet.

## Class: UsersExport

The `UsersExport` class implements two interfaces: `FromCollection` and `WithHeadings`, which are essential for exporting data with predefined headers from a collection of data.

### Methods

#### 1\. `collection()`

-   **Purpose**: To fetch user data from the database, formatted and filtered as required for the export.
-   **Return Type**: `\Illuminate\Support\Collection`

**Description**:

This method performs a complex query on the `User` model, joining with several other tables (`groups`, `civilites`, `parcours`, `diplomes`) to fetch a rich set of user attributes. The data is then ordered by several criteria to ensure a well-structured output.

**Query Breakdown**:

-   **Selects**: Specific fields from the `users` table and related tables, renaming some with `as` for clarity.
-   **Joins**: Links the `users` table with `groups`, `civilites`, `parcours`, and `diplomes` to enrich the user data.
-   **Order**: Orders the resulting data by `nom` (name), then `group_id`, `parcour_id`, and `diplome_id` for structured sorting.

```php
return User::select("nom", "prenom", "email", "image", "role", "groups.label as group", "statut", "civilites.label as civilite", "parcours.label as parcours", "diplomes.code as diplome", "code_diplome")
    ->join('groups', 'users.group_id', '=', 'groups.id')
    ->join('civilites', 'users.civilite_id', '=', 'civilites.id')
    ->join('parcours', 'users.parcour_id', '=', 'parcours.id')
    ->join('diplomes', 'users.diplome_id', '=', 'diplomes.id')
    ->orderBy('nom')
    ->orderBy('group_id')
    ->orderBy('parcour_id')
    ->orderBy('diplome_id')
    ->get();
```

#### 2\. `headings()`

-   **Purpose**: To define custom headings for the Excel sheet.
-   **Return Type**: `array`

**Description**:

This method returns an array of strings that are used as column headers in the exported Excel file. These headers correspond directly to the selected attributes in the `collection` method, ensuring consistency between the data and its representation.

**Headers**:

```php
return ["nom", "prenom", "email", "image", "role", "group", "statut", "civilite", "parcours", "diplome", "code_edt"];
```

## Use Case

The `UsersExport` class is designed for use cases where an admin or authorized user needs to export a structured list of users, including detailed information such as group, status, civility, course, and diploma information. This could be useful for reporting, analysis, or data migration purposes.

## Emoji Summary

-   📝 **Data Export**: Facilitates structured data exports.
-   🤝 **Join Logic**: Integrates data from multiple related tables.
-   📊 **Ordering**: Ensures data is well-ordered for readability and analysis.
-   📑 **Custom Headers**: Provides clarity and structure to the exported data through predefined headers.

By leveraging Laravel's Eloquent ORM alongside the Maatwebsite Excel package, `UsersExport.php` offers a powerful yet flexible solution for data export needs within the application.

# UserController.php Documentation

`UserController.php` is a controller file in a Laravel application that manages user-related functionalities. It primarily deals with exporting, importing, and listing users within the application. This document explains the functionalities provided by the `UserController`.

## Table of Contents

-   [Overview](#overview)
-   [Methods](#methods)
    -   [index](#index)
    -   [export](#export)
    -   [import](#import)
-   [Dependencies](#dependencies)

## Overview

The `UserController` extends the base `Controller` class provided by Laravel and makes use of various other classes to perform its duties. It is part of the `App\Http\Controllers` namespace.

## Methods

### `index`

-   **Description**: Lists users in a paginated format.
-   **Route**: Typically accessed via a GET request.
-   **Permissions**: Requires authorization to view the import form.
-   **Returns**: A view named `users` with the users data.

```php
public function index() {
    $this->authorize('viewImportForm', \App\Models\User::class);
    $users = User::orderBy('nom')->paginate(15);
    return view('users', compact('users'));
}
```

### `export`

-   **Description**: Exports the users' data to an Excel file.
-   **Route**: Can be triggered via a route that handles exports.
-   **Returns**: An Excel file named `users.xlsx`.

```php
public function export() {
    return Excel::download(new UsersExport, 'users.xlsx');
}
```

### `import`

-   **Description**: Handles the importation of users from an Excel file.
-   **Route**: Activated through a POST request, typically from a form submission.
-   **Validation**: Ensures an import file is provided and is of type `xlsx` or `xls`.
-   **Post-action**: Redirects back with a success status message.

```php
public function import(Request $request) {
    $request->validate([
        'import_file' => [
            'required',
            'file',
            'mimes:xlsx,xls',
        ]
    ]);
    Excel::import(new UsersListImport, $request->file('import_file'));
    return redirect()->back()->with('status', 'Importation réussie !');
}
```

## Dependencies

-   **Models**:
    -   `App\Models\User`: Interacts with the users' data.
-   **Imports**:
    -   `App\Exports\UsersExport`: Responsible for exporting users.
    -   `App\Imports\UsersImport` & `App\Imports\UsersListImport`: Handle the logic of importing users.
-   **Others**:
    -   `Illuminate\Http\Request`: To handle HTTP requests.
    -   `Maatwebsite\Excel\Facades\Excel`: Facade for working with Excel files.
    -   `Illuminate\Support\Facades\Auth`: For authentication checks.
    -   `Illuminate\Support\Str`: For string operations, although not directly used in the provided methods.

The `UserController` is a critical component for managing users, especially in applications where user data needs to be exported for reports or imported from external sources. Through its methods, it provides an interface for these functionalities while ensuring proper validations and permissions are in place.

# API Controller Documentation

The `ApiController.php` file is a critical part of an application, responsible for interacting with an external API. This controller is designed to perform various operations such as connecting to the API, disconnecting, retrieving projects, resources, and events, among others. It has been implemented within the Laravel framework, utilizing the `Http` facade for making requests.

## Table of Contents

-   [Overview](#overview)
-   [Constructor](#constructor)
-   [Public Methods](#public-methods)
    -   [Connect](#connect)
    -   [Disconnect](#disconnect)
    -   [getProject](#getproject)
    -   [getResources](#getresources)
    -   [getAllProf](#getallprof)
    -   [getEvent](#getevent)
-   [Utility Methods](#utility-methods)
-   [Configuration](#configuration)
-   [Exception Handling](#exception-handing)

## Overview

**Namespace:** `App\Http\Controllers`

**Inherits:** `Controller`

**Description:** Handles API interactions by connecting to an external service, performing queries, and processing the response. It supports proxy configuration for network requests.

## Constructor

The constructor initializes the controller with configuration values specified in the application's `config/ade.php` file.

```php
public function __construct() {...}
```

**Parameters:**

-   Sets API credentials (login, password).
-   Sets server details (URL, protocol).
-   Optionally configures proxy settings.

## Public Methods

### Connect

Establishes a connection with the API server and retrieves a session ID.

```php
public function connect() {...}
```

**Return:** Session ID (string) upon successful connection.

### Disconnect

Terminates the current session with the API server.

```php
public function disconnect() {...}
```

**Return:** Message indicating the disconnection status.

### getProject

Retrieves information about projects from the API.

```php
public function getProject($sessionId = null, $idProject = null, $detail = null) {...}
```

**Parameters:**

-   `$sessionId` (optional): Session ID.
-   `$idProject` (optional): Specific project ID.
-   `$detail` (optional): Level of detail for the response.

**Return:** Project information (varies based on use of proxy).

### getResources

Fetches resource details based on specified criteria.

```php
public function getResources(...$wheres) {...}
```

**Parameters:**

-   `...$wheres`: Variable-length argument list specifying filter criteria.

**Return:** Resource details.

### getAllProf

Retrieves all instructors from the API.

```php
public function getAllProf(...$wheres) {...}
```

**Parameters:** Similar to `getResources`.

**Return:** Instructor details.

### getEvent

Fetches event details based on specified criteria.

```php
public function getEvent(...$wheres) {...}
```

**Parameters:** Similar to `getResources`.

**Return:** Event details.

## Utility Methods

Includes methods for setting and getting object properties, building request URLs, and adding parameters to the request.

-   `setLogin`, `getLogin`, `setMdp`, `getMdp`, etc.
-   `getUrlBase`, `getUrlProxyBase`
-   `addSessionId`, `addFunction`, `addElementUrl`

## Configuration

The controller relies on external configuration defined in `config/ade.php`. This includes API credentials, server details, and optional proxy settings.

## Exception Handling

The code includes instances where custom exceptions may be thrown for specific error conditions, such as `NotGoodValueException` and `NotAllowedException`. Proper exception handling strategies should be in place to manage these cases.

---

🔍 **Note:** This documentation provides a high-level overview of the `ApiController` functionalities and structure. The actual implementation details may vary based on the specific requirements and configurations of your Laravel application.

# ProfileController Documentation

`ProfileController.php` is a comprehensive PHP controller file that belongs to the Laravel application. It is part of the `App\Http\Controllers` namespace. This controller manages various user profile operations, including profile viewing and editing, handling attendance (appel), managing absences, and integrating with an API for timetable and events management.

Below, find a breakdown of the functionalities provided by `ProfileController`.

## Table of Contents

-   [Initialization](#initialization)
-   [User Profile Management](#user-profile-management)
-   [Timetable and Event Management](#timetable-and-event-management)
-   [Attendance Management](#attendance-management)
-   [Absence Management](#absence-management)

## Initialization

|    <h2><h2>Variable</h2></h2>     |  <h2><h2>Type</h2></h2>   |                   <h2><h2>Description</h2></h2>                   |
| :-------------------------------: | :-----------------------: | :---------------------------------------------------------------: |
|     <h2><h2>`$api`</h2></h2>      | <h2><h2>public</h2></h2>  |     <h2><h2>Holds the instance of `ApiController`.</h2></h2>      |
|  <h2><h2>`$sessionID`</h2></h2>   | <h2><h2>private</h2></h2> |       <h2><h2>Stores the session ID from the API.</h2></h2>       |
|   <h2><h2>`$projects`</h2></h2>   | <h2><h2>private</h2></h2> |     <h2><h2>Contains projects fetched from the API.</h2></h2>     |
|   <h2><h2>`$project`</h2></h2>    | <h2><h2>private</h2></h2> |           <h2><h2>Stores the current project.</h2></h2>           |
|  <h2><h2>`$ressources`</h2></h2>  | <h2><h2>private</h2></h2> |          <h2><h2>Holds resources from the API.</h2></h2>          |
|    <h2><h2>`$events`</h2></h2>    | <h2><h2>private</h2></h2> |      <h2><h2>Contains events fetched from the API.</h2></h2>      |
| <h2><h2>`$joursSemaine`</h2></h2> | <h2><h2>public</h2></h2>  | <h2><h2>An array listing days of the week with details.</h2></h2> |

##

##

### Initialization of API ADE

-   **`__construct(ApiController $api)`**: Initializes the controller with days of the week and connects to the API.
-   **`initApi()`**: Initializes the API by fetching resources based on the authenticated user's diploma code.

## User Profile Management

|  <h2><h2>Method</h2></h2>   |      <h2><h2>Route</h2></h2>      | <h2><h2>HTTP Verb</h2></h2> |           <h2><h2>Description</h2></h2>            |
| :-------------------------: | :-------------------------------: | :-------------------------: | :------------------------------------------------: |
|  <h2><h2>`edit`</h2></h2>   | <h2><h2>`/profile/edit`</h2></h2> |    <h2><h2>GET</h2></h2>    |   <h2><h2>Shows the profile edit form.</h2></h2>   |
|  <h2><h2>`show`</h2></h2>   |   <h2><h2>`/profile`</h2></h2>    |    <h2><h2>GET</h2></h2>    |   <h2><h2>Displays the user's profile.</h2></h2>   |
| <h2><h2>`update`</h2></h2>  |   <h2><h2>`/profile`</h2></h2>    |    <h2><h2>PUT</h2></h2>    | <h2><h2>Updates the user's profile data.</h2></h2> |
| <h2><h2>`destroy`</h2></h2> |   <h2><h2>`/profile`</h2></h2>    |  <h2><h2>DELETE</h2></h2>   |   <h2><h2>Deletes the user's account.</h2></h2>    |

##

##

## Timetable and Event Management

-   **`evenements()`**: Fetches weekly events from the API.
-   **`AllEvenements()`**: Fetches all events from the API.
-   **`initDays()`**: Initializes the days for the current week.
-   **`initHours()`**: Initializes the hours for the timetable.
-   **`nextEvent()`**: Finds the next event from the current time.
-   **`currentEvent()`**: Finds the current ongoing event.
-   **`EvenementsByDate()`**: Organizes events by date.
-   **`index()`**: Main function that prepares data for the home page based on the user's group and events.

## Attendance Management

-   Methods like `appel()`, `appel_verif()`, and `appel_store()` manage the attendance process, including verification and storage.
-   **`generate($unique)`**: Generates a QR code for attendance verification.
-   **`presence($idcour)`**: Marks the presence for a course based on the scanned QR code.
-   **`scan()`**: Marks the logged-in user as present.

## Absence Management

-   **`absences()`**: Fetches absence records for the logged-in user.
-   **`justifier_absence(Request $request)`**: Prepares the form for justifying an absence.
-   **`justifier_absence_store(Request $request)`**: Stores the justification document for an absence.

`ProfileController.php` utilizes various Laravel features such as Eloquent ORM for database interactions, Request validation, Facades for authentication, and session management. It also demonstrates how to integrate external APIs into a Laravel application.
