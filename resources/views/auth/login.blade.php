<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        
        <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="/login" method="POST">
                        @csrf
    
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="name" name="name" class="form-control" placeholder="name/email" />
                        </div>
    
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Contraseña" />
                        </div>
    
                        <!-- Submit button -->
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>

                        <!-- Registrarse -->
                        <div class="text-center mb-4">
                            <a href="/register" >Registrarse</a>
                        </div>
    
                    </form>
                </div>
            </div>
        </div>


        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
