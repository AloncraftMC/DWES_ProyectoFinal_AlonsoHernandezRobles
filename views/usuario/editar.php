<?php use helpers\Utils; ?>

<h1 style="margin-bottom: 0px">Editar Usuario</h1>

<?php
    use models\Usuario;
    $usuario = Usuario::getById($_GET['id']);
?>

<h3><?=$usuario->getNombre()?> <?=$usuario->getApellidos()?></h3>

<form method="post" action="<?=BASE_URL?>usuario/editar&id=<?=$_GET['id']?>" enctype="multipart/form-data">
    
    <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= isset($_SESSION['form_data']['nombre']) ? $_SESSION['form_data']['nombre'] : $usuario->getNombre() ?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_nombre'): ?>

            <small class="error">El nombre, de al menos 2 caracteres, solo puede contener letras y espacios.</small>
            <?php Utils::deleteSession('gestion'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?= isset($_SESSION['form_data']['apellidos']) ? $_SESSION['form_data']['apellidos'] : $usuario->getApellidos() ?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_apellidos'): ?>

            <small class="error">Los apellidos, de al menos 2 caracteres, solo pueden contener letras y espacios.</small>
            <?php Utils::deleteSession('gestion'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : $usuario->getEmail() ?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_email'): ?>

            <small class="error">Introduce un email válido.</small>
            <?php Utils::deleteSession('gestion'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="password">Contraseña</label>
        <input type="password" name="password" value="<?= isset($_SESSION['form_data']['password']) ? $_SESSION['form_data']['password'] : '' ?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_password'): ?>

            <small class="error">La contraseña debe tener mínimo 8 caracteres, una letra y un número.</small>
            <?php Utils::deleteSession('gestion'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">
        
        <label for="rol">Rol</label>
            
        <select name="rol">

            <option value="user" <?= (isset($_SESSION['form_data']['rol']) && $_SESSION['form_data']['rol'] == 'user') ? 'selected' : ($usuario->getRol() == 'user' ? 'selected' : '') ?>>Usuario</option>
            <option value="admin" <?= (isset($_SESSION['form_data']['rol']) && $_SESSION['form_data']['rol'] == 'admin') ? 'selected' : ($usuario->getRol() == 'admin' ? 'selected' : '') ?>>Administrador</option>
        
        </select>
    </div>

    <!-- Sección de Imagen -->
    <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen-input">
        
        <div id="error-imagen" style="display: none;">
            <small class="error">La imagen debe ser jpg, png o svg.</small>
        </div>

        <div style="margin-top: 10px; display: flex; justify-content: center; align-items: center; width: 100%;">
            <?php
            
                $imagenActual = $usuario->getImagen();
                $imagenURL = $imagenActual ? BASE_URL . "assets/images/uploads/usuarios/" . $imagenActual : "#";
            ?>
            <img id="imagen-preview" src="<?= $imagenURL ?>" alt="Vista previa de la imagen" style="<?= $imagenActual ? 'display: block;' : 'display: none;' ?> min-height: 100px; max-height: 100px; border-radius: 5px;">
            <button id="eliminar-imagen" type="button" class="delete-image" style="display: none; margin-left: 10px;">
                Eliminar imagen
            </button>
        </div>

        <script>
            (function(){
                const inputImagen = document.querySelector('#imagen-input');
                const imagenPreview = document.querySelector('#imagen-preview');
                const btnEliminar = document.querySelector('#eliminar-imagen');
                const errorImagen = document.getElementById('error-imagen');
                // Guardamos la URL original para poder restaurarla
                const originalSrc = imagenPreview.getAttribute('src');

                inputImagen.addEventListener('change', function() {
                    const imagen = this.files[0];
                    if (imagen) {
                        const extension = imagen.name.split('.').pop().toLowerCase();
                        const extensionesValidas = ['jpg', 'jpeg', 'png', 'svg'];
                        
                        if (extensionesValidas.includes(extension)) {
                            errorImagen.style.display = 'none';
                            const reader = new FileReader();
                            
                            reader.onload = function(e) {
                                // Mostramos la imagen seleccionada en el preview
                                imagenPreview.src = e.target.result;
                                imagenPreview.style.display = 'block';
                                imagenPreview.style.marginTop = '20px';
                                // Mostramos el botón para eliminar la nueva imagen
                                btnEliminar.style.display = 'block';
                                btnEliminar.style.marginTop = '30px';
                            };
                            
                            reader.readAsDataURL(imagen);
                        } else {
                            // En caso de formato no válido, mostramos error y limpiamos el input
                            errorImagen.style.display = 'block';
                            inputImagen.value = '';
                        }
                    }
                });

                btnEliminar.addEventListener('click', function() {
                    // Al pulsar "Eliminar imagen", se restaura la imagen original...
                    imagenPreview.src = originalSrc;
                    // ...se oculta el botón eliminar...
                    btnEliminar.style.display = 'none';
                    // ...y se limpia el input file.
                    inputImagen.value = '';
                });
            })();
        </script>
    </div>

    <button type="submit">Guardar Cambios</button>

</form>

<?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'nothing'): ?>

    <strong class="yellow">No se ha modificado ningún dato.</strong>

<?php elseif(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed'): ?>

    <strong class="red">Edición de datos fallida, introduce bien los datos.</strong>

<?php endif; ?>

<?php Utils::deleteSession('gestion'); ?>
<?php Utils::deleteSession('form_data'); ?>