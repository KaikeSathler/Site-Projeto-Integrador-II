<nav class="bg-sky-300 p-2 w-100 dark:bg-slate-800">
      <ul class="flex gap-3 justify-between items-center">
        <div class=" title_icon sm:gap-3 flex items-center">
          <li><img id="iconv" src="/img/icon/icob.png" width="48" class="  select-none "></li>
          <li><a class=" title_icon_container !font-mono text-2xl text-sky-900 dark:text-white">Visuais I</a></li>
        </div>
        <div class="flex gap-3 items-center">
          <?php
          if (!empty($_SESSION['ARTESDB_SESSION']) || !empty($_SESSION['google_id'])) {
            if(isset($_SESSION['google_id'])) {
              $imagem = $_SESSION['google_picture'];
              echo " <div id='p-login'> " . (isset($_SESSION['google_picture']) ? ("<img class='select-none ' src='$imagem' style=' border-radius: 100%; width: 2.5rem; margin-right: 0.30rem;'/>") : "") . "
                  </div>
                    <div
                   class=' name_google select-none text-sky-900 border-none sm:border-solid sm:border-r-2 dark:text-white pr-15 sm:pr-12 text-center dark:border-white sm:border-sky-900'>Olá, " . (isset($_SESSION['google_id']) ? $_SESSION['google_name'] : "") . PHP_EOL;

            } else if(isset($_SESSION['ARTESDB_SESSION'])) {
              $sessionDetails = unserialize($_SESSION['ARTESDB_SESSION']);
              echo " <div id='p-login'>
                  </div>
                  <div class=' name_google  dark:text-white pr-16 sm:pr-12'>Olá, " . (isset($sessionDetails['nome']) ? $sessionDetails['nome'] : "") . PHP_EOL;
            }
          }
          ?>
        </div>
        <div class="flex items-center gap-8 px-3">
          <i class=" trocartema !flex items-center fa-solid fa-sun fa-xl text-sky-900 align-middle rounded cursor-pointer dark:text-white" onclick="javascript:trocarTema();"></i>
          <i class=" flex fa fa-bars fa-xl cursor-pointer text-sky-900 dark:text-white" onclick="javascript:abrirOffCanvas();"></i>
        </div>
      </ul>
    </nav>