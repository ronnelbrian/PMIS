function schedTable(data, div){
	var day_code = ['M', 'T', 'W', 'TH', 'F', 'S', 'SU'];
	var day = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
	var div_ = '<table style="border-collapse: separate; border-spacing: 2px;" class="table"><thead><tr><th width="16%">TIME</th>';
	for(j=0; j<day_code.length; j++){
		div_+='<th width="12%">'+day[j]+'</th>';
	}
	div.append('</tr></thead>');
	var time = '06:30:00';
	var p = 'AM';
	var colors = ['#EBEBFF', '#FFCCCC'];
	var borders = ['#8585FF', '#FF9999'];
	var lines = [];
	var revs = "";
	var count = 0;
	var ex = false;
	do{
		// sort asc order
		ex = false;
		for(c = 0; c<data.length-1; c++){
			if(new Date("01/01/2001 "+data[c]["TIME_S"]) > new Date("01/01/2001 "+data[c+1]["TIME_S"])){
				var temp = data[c];
				data[c] = data[c+1];
				data[c+1] = temp;
				ex=true;
			}
		}
	}while(ex);
	do{
		if(time == '12:00:00' && p == 'AM' && count != 0){
			p = 'PM';
		}
		if(time.split(':')[0] == 12){
			var temp = time.split(":");
			temp[0] = 0;
			time = temp.join(':');
		}
		//if(time.split(':')[1] == "00" || time.split(':')[1] == "30")
			var hr = (time.split(':')[0]%12==0)?12:time.split(':')[0]%12;
			div_+='<tr><td style="padding-top:0px;"><b>'+hr+':'+time.split(':')[1]+' '+p+'</b></td>';
		//else
		//	div_+='<tr><td></td>';
		var line = [];
		for(j=0; j<day_code.length; j++){
			var in_line = new Array();
			var rowspan;
			for(i=0; i<data.length; i++){
				if(data[i]["DAY"] == day_code[j]){
					//var sep = (i > 0 && i != data.length-1)? "/<br/><br/>":"";
					var s_ap = (parseInt(data[i]["TIME_S"].split(':')[0]) < 12)?"AM":"PM";
					var e_ap = (parseInt(data[i]["TIME_E"].split(':')[0]) < 12)?"AM":"PM";
					var room = (data[i]["ROOM"] == null)?"":data[i]["ROOM"];
					var s_hr = (parseInt(data[i]["TIME_S"].split(':')[0])%12 == 0)?12:parseInt(data[i]["TIME_S"].split(':')[0])%12;
					var e_hr = (parseInt(data[i]["TIME_E"].split(':')[0])%12 == 0)?12:parseInt(data[i]["TIME_E"].split(':')[0])%12;
					var start = s_hr+':'+data[i]["TIME_S"].split(':')[1]+' '+s_ap;
					var end = e_hr+':'+data[i]["TIME_E"].split(':')[1]+' '+e_ap;
					var desc = start+'<br/>to<br/>'+end+'<br/><b>'+data[i]["SUBJECT"]+'</b><br/>'+room;
					if(new Date("01/01/2001 "+convertP(time, p)) >= new Date("01/01/2001 "+data[i]["TIME_S"])
						&& new Date("01/01/2001 "+convertP(time, p)) < new Date("01/01/2001 "+data[i]["TIME_E"])
					){
						//fill data
						rowspan = (new Date("01/01/2001 "+data[i]["TIME_E"])-new Date("01/01/2001 "+data[i]["TIME_S"]))/1000/60/30;
						var attr = data[i]["TIME_S"];
						in_line.push({"desc":desc, "rowspan": rowspan, "attr": attr});
					}
				}
			}
			var style = "height:50px; text-align:center;";
			if(in_line.length != 0){
				var first = [];
				var cont = "";
				for(k=0;k<in_line.length;k++){
					if(count == 0){
						first.push(k);
					}
					else{
						if(lines[count-1][j].length == 0)
							first.push(k);
						else{
							var f = true;
							for(l=0; l<lines[count-1][j].length; l++){
								if(lines[count-1][j][l]["desc"] == in_line[k]["desc"]){
									f = false;
								}
							}
							if(f){
								first.push(k);
							}
						}
					}
				}
				
				if(in_line.length == 1){
					//green
					if(first.length == 1 && in_line[first[0]]["attr"] == convertP(time, p)){
						style += "border: 1px solid"+borders[0]+";";
						style += "margin: 1px;";
						style += "background-color: "+colors[0]+";";
						div_+='<td style="'+style+'" time_start="'+in_line[first[0]]["attr"]+'" rowspan="'+in_line[first[0]]["rowspan"]+'">'+in_line[first[0]]["desc"]+'</td>';
					}
				}else{
					//red
					style += "border: 1px solid"+borders[1]+";";
					style += "margin: 1px;";
					style += "background-color: "+colors[1]+";";
					var temp = [{"desc":"", "attr": "", "rowspan":0}];
					for(k = 0; k<in_line.length; k++){
						var f = false;
						for(l=0; l<first.length; l++){
							if(in_line[k]["desc"] == in_line[first[l]]["desc"])
								f = true;
						}

						if(f && first.length == 1 && in_line[k]["attr"] == convertP(time, p)){
							if(k!= 0){
								var lapse = ((new Date("01/01/2001 "+in_line[k-1]["attr"])-new Date("01/01/2001 "+in_line[k]["attr"]))/1000/60/30) * -1;
								revs+='$("[time_start =\''+in_line[k-1]["attr"]+'\']").attr("rowspan", '+lapse+');';
							}
							div_+='<td style="'+style+'" time_start="'+in_line[k]["attr"]+'" rowspan="'+in_line[k]["rowspan"]+'">'+in_line[k]["desc"]+'</td>';
							
						}else if(f && first.length > 1 && in_line[k]["attr"] == convertP(time, p)){
							temp[0]["desc"]+= in_line[k]["desc"]+"<br/><br/>";
							temp[0]["attr"] = in_line[k]["attr"];
							temp[0]["rowspan"] = (in_line[k]["rowspan"] > temp[0]["rowspan"])?in_line[k]["rowspan"]:temp[0]["rowspan"];
						}
					}
					if(first.length > 1){
						div_+='<td style="'+style+'" time_start="'+temp[0]["attr"]+'" rowspan="'+temp[0]["rowspan"]+'">'+temp[0]["desc"]+'</td>';
					}
				}
			}else{
				div_+='<td style="'+style+'"></td>';
			}	
			line.push(in_line);
		}
		lines.push(line);
		count++;
		div_+='</tr>';
		time = addMinutes(time, 30);
	}while(count != 16*(60/30));
	div.html(div_+"<script>"+revs+"</script>");
}
function addMinutes(time, minsToAdd) {
  function z(n){ return (n<10? '0':'') + n;};
  var bits = time.split(':');
  var mins = bits[0]*60 + +bits[1] + +minsToAdd;

  return z(mins%(24*60)/60 | 0) + ':' + z(mins%60)+":00";  
}
function convertP(time, p){
	var hr = time.split(':');
	if(p == 'PM')
		hr[0] = parseInt(hr[0])+12;
	return hr.join(':');
}