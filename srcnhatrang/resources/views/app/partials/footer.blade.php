<!-- <footer id="footer" class="module footer">
  <div class="container footer-top bg-gray-500">
    <div class="row">
      <ul class="list-none col p-0 w-1/2 lg:w-2/3">
        {!! App::getFooterNav() !!}
      </ul>
      <div class="footer-item-col col w-1/2 lg:w-1/3">
        {!! App::getFooterAddress() !!}
      </div>
    </div>
  </div>
  <div class="container text-center footer-bottom">
    <div class="footer-copyright last-mb-none p-3">
      {!! App::getCopyRight() !!}
    </div>
  </div>
</footer> -->
<footer id="footer" class="module footer h-226.5 flex items-end justify-center down_1920:h-210 down_xl:h-182 down_lg:items-center down_lg:h-220">
  <div class=" w-62vw h-91 down_1920:w-85vw down_xl:w-90vw down_xl:pl-25 down_xl:h-97.5">
    <div class="row items-center justify-center h-42 down_1920:h-44 down_xl:-mt-1 down_lg:mt-10.5 down_lg:-ml-32">
    <div class="col w-full order-first down_xl:w-1/2">
          <img src="" class="lazy w-111.5 ml-8 mb-9 down_1920:ml-22 down_xl:ml-0 down_xl:mt-7 down_xl:mb-0 down_lg:ml-auto down_lg:mr-auto" data-src="@asset('images/footer/footer_logo.png')" alt="logo footer">
      </div>
      <div class="col w-1/5 pl-1.5 down_xl:w-1/3 down_1920:ml-0 down_xl:pl-10 down_xl:order-3 down_lg:w-full down_lg:order-2 down_lg:mt-11.5 down_lg:ml-0">
          <div class="w-89 down_1920:ml-11 down_xl:-ml-8 down_xl:-mt-2 down_lg:ml-auto down_lg:mr-auto flex">
            {!! App::getSocial() !!}
          </div>
      </div>
      <div class="col w-3/5 down_xl:w-2/3 down_xl:order-4 down_xl:pt-9.5 down_xl:pl-0 down_xl:-ml-12 down_lg:w-full down_lg:order-3 down_lg:ml-12 down_lg:mt-4.5">
        {!! App::getFooterNav() !!}
      </div>
      <div class="col w-1/5 -ml-28 down_1920:-ml-33 down_xl:w-1/2 down_xl:-ml-1 down_xl:order-2 down_lg:w-full down_lg:order-4 flex down_lg:-mt-7 down_lg:ml-0">
        <a href="http://localhost:3000/" class="text-white text-center flex font-extrabold no-underline bg-none border-white border-4 rounded-57px pt-5 pb-5 pl-26.5 pr-26.5 tracking-2 text-16 ml-auto mr-auto down_xl:mr-0 down_lg:mr-auto">CONTACT</a>
      </div>
    </div>
    <div class="coppy-right order-5 flex down_lg:justify-center down_lg:mt-50 down_lg:-ml-18">
    {!! App::getCopyRight() !!}
    </div>
  </div>
</footer>

<!-- endblock -->
<noscript>
<div id="mod-noscript" class="mod-noscript bg-black text-white fixed inset-0 z-200">
    <div class="table w-full h-full">
      <div class="table-cell align-middle text-center">
        <div class="container last-mb-none">
          <h3>To use web better, please enable Javascript.</h3>
        </div>
      </div>
    </div>
  </div>
</noscript>

