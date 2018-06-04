function chuksButton(btnClass,btnId,btnName,btnTitle,btnEvent){
  return '<button type="button" class="'+btnClass+'" id="'+btnId+'" title="'+btnTitle+'" '+btnEvent+' >'+btnName+'</button>';
}

function spanMessage(value,style){
  return "<span style="+style+">"+value+"</span>";
}

function returnTrimValue(input) {
  return input.value.trim();
}