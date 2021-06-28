<footer  class="page-footer grey darken-3">
    <div class="footer-copyright grey darken-3">
        <div class="container">
            <span>Copyright © 2021 Malycia. Tous droits réservés</span>
            <a class="grey-text text-lighten-4 right" href="#!">Contact</a>
        </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<?php if ($js) : ?>
    <?php foreach ($js as $script): ?>
        <script src="js/<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>