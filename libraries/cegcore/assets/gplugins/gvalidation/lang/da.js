jQuery.gvalidation.errors = $.extend(jQuery.gvalidation.errors, {
	required: "Dette felt skal udfyldes.",
	alpha: "Dette felt accepterer kun alfabetiske tegn.",
	alphanum: "Dette felt accepterer kun alfanumeriske tegn.",
	nodigit: "Cifre ikke accepteret.",
	digit: "Skriv venligst et gyldigt heltal.",
	digitmin: "Tallet skal være mindst %1",
	digitltd: "Værdien skal være mellem %1 og %2",
	number: "Skriv venligst et gyldigt nummer.",
	email: "Skriv venligst en gyldig e-mail adresse: <br /><span>F.eks: ditnavn@gmail.com</span>",
	image : 'Dette felt bør kun indeholde gyldige billedtyper.',
	phone: "Skriv venligst et gyldigt telefonnummer.",
	url: "Skriv venligst et gyldigt url: <br /><span>F.eks: http://www.google.com</span>",

	confirm: "Dette felt er forskelligt fra %1",
	differs: "Denne værdi skal være anderledes end %1",
	length_str: "Længden er inkorrekt, den skal være mellem %1 og %2",
	length_fix: "Længden er inkorrekt, den skal være præcis %1 tegn.",
	lengthmax: "Længden er inkorrekt, den skal max være %1",
	lengthmin: "Længden er inkorrekt, den skal mindst være %1",
	words_min : "Dette felt skal mindst indeholde %1 ord, iøjeblikket: %2 ord",
	words_range : "Dette felt skal indeholde %1-%2 ord, iøjeblikket: %3 ord",
	words_max : "Dette felt må max indeholde %1 ord, iøjeblikket: %2 ord",
	checkbox: "Afkryds venligst denne boks.",
	group : 'Afkryds venligst mindst %1 boks(e)',
	custom: "Afkryds venligst en af mulighederne.",
	select: "Vælg venligst en af værdierne."
});