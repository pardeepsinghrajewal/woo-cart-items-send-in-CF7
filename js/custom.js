jQuery( document ).ready(function() 
{
  console.log(' Ready!! ');
  wcCartPage();
});

function wcCartPage()
{
  const cCHF      = document.querySelector('#wcCartContentHiddenField');
  const cPCF      = document.querySelector('#cartPopupContactForm');
  const cContent  = document.querySelector('#wcCartContent');
  const mClose    = document.querySelector('#modalClose');
  const myModal   = document.querySelector('#myModal');

  
  if(typeof cPCF === 'object' && cPCF !== null)
  {
    cPCF.addEventListener('click', function (e) 
    {
      e.preventDefault();
      if(typeof mClose === 'object' && mClose !== null)
      {
        myModal.style.display = 'block';
      }
      if(typeof cContent === 'object' && cContent !== null)
      {
        cCHF.value = cContent.innerHTML;
      }
    });
  }

  if(typeof mClose === 'object' && mClose !== null)
  {
    mClose.addEventListener('click', function (e) 
    {
      e.preventDefault();
      if(typeof mClose === 'object' && mClose !== null)
      {
        myModal.style.display = 'none';
      }
    });
  }

}


