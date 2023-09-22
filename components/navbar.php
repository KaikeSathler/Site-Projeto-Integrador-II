<nav class="bg-sky-300 p-2 w-100 dark:bg-slate-800">
      <ul class="flex gap-4 justify-between items-center">
        <div class="flex gap-4 items-center">
          <li><img id="iconv" src="/img/icon/icob.png" width="48" class="  select-none hidden sm:block"></li>
          <li><a class="!font-mono text-2xl text-sky-900 dark:text-white">Visuais I</a></li>
        </div>
        <div class="flex gap-1 items-center">
          <?php
          if (!empty($_SESSION['ARTESDB_SESSION']) || !empty($_SESSION['google_id'])) {
            if(isset($_SESSION['google_id'])) {
              $imagem = $_SESSION['google_picture'];
              echo " <div id='p-login'> " . (isset($_SESSION['google_picture']) ? ("<img class='select-none ' src='$imagem' style=' border-radius: 100%; width: 43px; margin-right: 6px;'/>") : "") . "
                  </div>
                    <div
                   class=' select-none text-sky-900 dark:text-white p-2 rounded flex flex-row gap-2 items-center'>Olá, " . (isset($_SESSION['google_id']) ? $_SESSION['google_name'] : "") . PHP_EOL;

            } else if(isset($_SESSION['ARTESDB_SESSION'])) {
              $sessionDetails = unserialize($_SESSION['ARTESDB_SESSION']);
              echo " <div id='p-login'>
                  </div>
                  <div class=' dark:text-white p-2 rounded flex flex-row gap-2 items-center'>Olá, " . (isset($sessionDetails['nome']) ? $sessionDetails['nome'] : "") . PHP_EOL;
            }
          }
          ?>
          <i class=" trocartema !flex items-center fa-solid fa-sun fa-xl px-5 text-sky-900 align-middle rounded cursor-pointer dark:text-white" onclick="javascript:trocarTema();"></i>
          <i class=" flex p-3 fa fa-bars fa-xl cursor-pointer text-sky-900 dark:text-white" onclick="javascript:abrirOffCanvas();"></i>
        </div>
      </ul>
    </nav>