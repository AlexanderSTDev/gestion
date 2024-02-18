<a href="#" class="content-menu-toggle btn btn-primary"><i class="material-icons">menu</i> content</a>
<div class="content-menu content-menu-right">
    <ul class="list-unstyled">
        <li><a href="<?php echo BASE_URL . 'archivos' ?>" class="<?php echo ($data['active'] == 'Todos' ? 'active' : '') ?>">Todos</a></li>
        <li><a href="<?php echo BASE_URL . 'admin' ?>" class="<?php echo ($data['active'] == 'Recientes' ? 'active' : '') ?>">Recentes</a></li>
        <li><a href="#">My Devices</a></li>
        <li><a href="#">Important</a></li>
        <li><a href="#" class="<?php echo ($data['active'] == 'Delete' ? 'active' : '') ?>">Eliminar</a></li>
        <li class="divider"></li>
        <li><a href="#" class="<?php echo ($data['active'] == 'Detail' ? 'active' : '') ?>">Detalles</a></li>
        <li><a href="#" class="<?php echo ($data['active'] == 'Shared' ? 'active' : '') ?>">Compartidos</a></li>
        <!-- <li><a href="#">My Collections</a></li>
        <li><a href="#">Settings</a></li> -->
    </ul>
</div>