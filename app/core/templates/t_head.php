<link href='<?php echo APP_RESOURCES;?>css/fp_style.css' media="screen" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../resources/css/style.css">


<!-- jquery and colorobox -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">$.noConflict();</script> 

<!-- TINYMCE    <script>tinymce.init({selector:'textarea'});</script>    
<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
-->
<script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/colorbox/jquery.colorbox-min.js"></script>

<link href="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.css" media="screen" rel="stylesheet" type="text/css" />




<script  type="text/javascript">


//////////////////////////////////////////////MENU EDITING /////////////////////////////////////////



jQuery(document).ready(function($) {

	var equalHeight = 0;

	function greater(  height){
		if(height >equalHeight){
			equalHeight = height;
		}
		return;
	}


		//objetivo de ir buscar altura/comprimento do elemento pai para fazer o cobrimento da área do fp_edit
		
		$('.menuEdit__row').each(function() {
			var nameWidth = $(this).find('.menuEdit__row__name').width();
			var descriptionWidth = $(this).find('.menuEdit__row__description').width();
			var priceWidth = $(this).find('.menuEdit__row__price').width();

			var heightDescription = $(this).find('.menuEdit__row__description').height();
			console.log(heightDescription);
			greater( heightDescription);

			$(this).find('.menuEdit__row__link__name').width(nameWidth-2); //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
			
			$(this).find('.menuEdit__row__link__description').width(descriptionWidth-2);
		
			$(this).find('.menuEdit__row__link__price').width(priceWidth-2); //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
			
		});

		console.log("equal height = " + equalHeight);
		$('.menuEdit__row').each(function() {
			$(this).find('.menuEdit__row__link__name').height( equalHeight-2); //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
			
			$(this).find('.menuEdit__row__link__description').height( equalHeight-2);
		
			$(this).find('.menuEdit__row__link__price').height( equalHeight-2); //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
			
			$(this).find('.menuEdit__row__link__delete__content').height( equalHeight); //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
			
			var deleteHeightString =   equalHeight + "px";
			
			$(this).find('.menuEdit__row__link__delete__content').css("line-height", deleteHeightString);
			
		});
	

		$('.menu__subTitle').each(function() {
			var subTitleWidth = $(this).find('.menu__subTitle__title').width();
			var subTitleHeight = $(this).find('.menu__subTitle__title').height();
			console.log("sub title witdh = " + subTitleWidth);
			console.log("sub title height = " + subTitleHeight);

			$(this).find('.menu__subTitle__title__edit').height(subTitleHeight-2).width(subTitleWidth-2); //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
		});


	

		//fazer hover na classe link e mostrar o link

		
		$('.menuEdit__row__name').mouseenter(function() { 						//procurar todas as classes fp_edit_type e dar hover no mouseenter
			$(this).find('.menuEdit__row__type__name').css("display", "block"); //acrescentar a classe hover
		}).mouseleave(function() {									    // fazer ação ao dar mouseleave
			$(this).find('.menuEdit__row__type__name').css("display", "none"); //tirar classe hover
		});

		$('.menuEdit__row__description').mouseenter(function() { 						//procurar todas as classes fp_edit_type e dar hover no mouseenter
			$(this).find('.menuEdit__row__type__description').css("display", "block"); //acrescentar a classe hover
		}).mouseleave(function() {									    // fazer ação ao dar mouseleave
			$(this).find('.menuEdit__row__type__description').css("display", "none"); //tirar classe hover
		});	

		
		$('.menuEdit__row__price').mouseenter(function() { 						//procurar todas as classes fp_edit_type e dar hover no mouseenter
			$(this).find('.menuEdit__row__type__price').css("display", "block"); //acrescentar a classe hover
		}).mouseleave(function() {									    // fazer ação ao dar mouseleave
			$(this).find('.menuEdit__row__type__price').css("display", "none"); //tirar classe hover
		});

		///// sub menu
		$('.menu__subTitle__title').mouseenter(function() { 						//procurar todas as classes fp_edit_type e dar hover no mouseenter
			$(this).parent().find('.menu__subTitle__type').css("display", "block"); //acrescentar a classe hover
		}).mouseleave(function() {									    // fazer ação ao dar mouseleave
			$(this).parent().find('.menu__subTitle__type').css("display", "none"); //tirar classe hover
		});



		

/*
		$('.menuList').each(function() {
			
			
			$(this).click(function(){
				console.log("olaaa inside");
				$(this).find('.menuList__header').slideToggle();
				$(this).find('.menuList__content').each(function(){
					$(this).slideToggle();
				});
			});			
		});

*/						
		
		//////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////PRATO DO DIA /////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////

		$('.mainDish__main__name').mouseenter(function() { 						//procurar todas as classes fp_edit_type e dar hover no mouseenter
			$(this).find('.mainDish__main__name__type').css("display", "block"); //acrescentar a classe hover
		}).mouseleave(function() {									    // fazer ação ao dar mouseleave
			$(this).find('.mainDish__main__name__type').css("display", "none"); //tirar classe hover
		});

		$('.mainDish__main__description').mouseenter(function() { 						//procurar todas as classes fp_edit_type e dar hover no mouseenter
			$(this).find('.mainDish__main__description__type').css("display", "block"); //acrescentar a classe hover
		}).mouseleave(function() {									    // fazer ação ao dar mouseleave
			$(this).find('.mainDish__main__description__type').css("display", "none"); //tirar classe hover
		});	

		
		$('.mainDish__main__price').mouseenter(function() { 						//procurar todas as classes fp_edit_type e dar hover no mouseenter
			$(this).find('.mainDish__main__price__type').css("display", "block"); //acrescentar a classe hover
		}).mouseleave(function() {									    // fazer ação ao dar mouseleave
			$(this).find('.mainDish__main__price__type').css("display", "none"); //tirar classe hover
		});

		$('.mainDish__main').each(function() {
			var nameWidth = $(this).find('.mainDish__main__name').width();
			var descriptionWidth = $(this).find('.mainDish__main__description').width();
			var priceWidth = $(this).find('.mainDish__main__price').width();

			
			var heightName = $(this).find('.mainDish__main__name').height();
			var heightDescription = $(this).find('.mainDish__main__description').height();
			var heightPrice = $(this).find('.mainDish__main__price').height()
			

			$(this).find('.mainDish__main__name__link').height(heightName-2).width(nameWidth-2);; //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
			
			$(this).find('.mainDish__main__description__link').height(heightDescription-2).width(descriptionWidth-2);;
		
			$(this).find('.mainDish__main__price__link').height(heightPrice-2).width(priceWidth-2); //encontrar a div com class fp_edit_link e dá-se a altura/width subtraido da border 1px que têm as duas classes
			//$(this).find('.mainDish__main__price__content').height(heightPrice).width(priceWidth);
		});


		$('.mainDishActivate').click(function(e) {
			e.preventDefault();
			var SITE_PATH = "http://localhost/_STEFAN_MVC/";

			var key;
			if ($(this).text() == "Ativar o prato do dia")
			{	
				key= 0;
				jQuery.ajax({
					url :SITE_PATH +  "app/cms/toggle.php?key="+key,
					dataType : 'json',
					async : false,
					success : function(msg) {
						if(msg.status == 1){
							alert("ativo");
						}else{
							alert("desativo");
						}
					}

				});


				$('.mainDish').toggle();
				$(this).text(  "Desativar o prato do dia") ;
				window.location.reload();
				
			}
			else {

				key= 1;
				jQuery.ajax({
					url :SITE_PATH +  "app/cms/toggle.php?key="+key,
					dataType : 'json',
					async : false,
					success : function(msg) {
						if(msg.status == 1){
							alert("ativo");
						}else{
							alert("desativo");
						}
					}

				});
				
				$('.mainDish').toggle();
				$(this).text(  "Ativar o prato do dia") ;
				window.location.reload();
			}



		});
		

	



		///PREVIEW PAGE
		
		$('#edit_toggle').click(function(e) {
			e.preventDefault();
			
			if ($(this).text() == 'Pré-visualização') //this é o elemento com id edit_toggle
			{
				$(this).text('Edição'); //dar toggle de preview page para edit page
			}
			else
			{
				$(this).text('Pré-visualização'); //toggle contrário
			}
			$('.mainDishActivate').toggle();
			$('.mainDish').toggle();
			$('.pratoPrincipal').toggle();
			$('.menuEdit').toggle(); //se tiver a hidden fica a shown e vice versa. isto vai afetar toda a visibilidade do estilo que definimos em fp_style.csss
			$('.menuFetch').toggle(); //se tiver a hidden fica a shown e vice versa
		});



		
			///aparecer a página edit.php num popup com colorbox
		$('.menuEdit__row__type__name, .menuEdit__row__link__name, .menuEdit__row__type__description, .menuEdit__row__link__description,  .menuEdit__row__type__price, .menuEdit__row__link__price , .menuEdit__row__add__type , .menuEdit__row__add__link, .menuEdit__row__type__delete, .menuEdit__row__type__delete, .menuEdit__row__menuSubtitle__type, .menuEdit__row__menuSubtitle__link, .menu__subTitle__delete, .menu__subTitle__title__edit, .menu__subTitle__type, .menuEdit__row__link__delete, .mainDish__main__name__link, .mainDish__main__name__type, .mainDish__main__description__type, .mainDish__main__description__link, .mainDish__main__price__type, .mainDish__main__price__link').click(function(e) {
			e.preventDefault();
			$(this).colorbox({
				//open: true;
				//iframe: true;
				
				transition: 'fade',
				initialWidth: '50px',
				initialHeight: '50px',
				cache: false,
				overlayClose: false,
				escKey: false,
				opacity: .6
				//não se coloca href porque o edit link já vem com o link e o colorbox faz isso automaticamente
			});
		});


			///aparecer a página edit.php num popup com colorbox .mainDish__form__upload__button
			

		
		
		$('.fp_dashboard, .fp_password').click(function(e) {
			$(this).colorbox({
				transition: 'fade',
				initialWidth: '50px',
				initialHeight: '50px',
				overlayClose: true,
				escKey: true,
				opacity: .6,
				cache: false,
				iframe: true,
				top: '28px',
				width: '940px',
				height: '80%'
			});
		});

		$('#fp_cancel,#cboxClose').on('click', function(){
			
			

			$.colorbox.close();
		});
		
	});









</script>