$(document).ready(function() {
	$("#achat").val("");
	$("#vente").val("");
	$("#salaries").val("");
	


	$(".btn-calculer").click(function (event)	{
		event.preventDefault();
		$("#step-1").css("display", "none");

		if( !($("#achat").val()) || isNaN($("#achat").val())  || !($("#vente").val()) || isNaN($("#vente").val()) || !($("#salaries").val()) || isNaN($("#salaries").val())   )
		{ 

		alert ("Les valeurs ne sont pas valides.");
		$("#step-1").css("display", "inline-block");
		$("#step-2").css("display", "none");
		$("#step-3").css("display", "none");
		}else{
			var nbFacturesAchat = $("#achat").val();
			var nbFacturesVente = $("#vente").val();
			var nbSalaries = $("#salaries").val();

			$("#nb-factures-achat").text(nbFacturesAchat);
			$("#nb-factures-vente").text(nbFacturesVente);
			$("#nb-salaries").text(nbSalaries);
			$("#step-2").css("display", "inline-block");
			$("#step-3").css("display", "none");
			$.ajax({
				dataType : "json",
				type: "POST",
				data: {
					factures_achat : nbFacturesAchat,
					factures_ventes : nbFacturesVente,
					salaries : nbSalaries
				},
				url: "php/calcul.php",
				success: function (data) {
				console.log(data);
					$("#val-min").text(data.min);
					$("#val-max").text(data.max);
				}			
			})  
		}

	});
})