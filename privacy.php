<meta charset="utf-8" />



<style rel="stylesheet" type="text/css">

article{
	border: 1px solid rgba(127,127,127,0.3);
	float: left;
	width: 260px;
	height: 250px;	
	padding-left: 20px; /* inside  */
	padding-right: 20px;
	margin-left: 20px; /* outside */
	background-color: white;
	border-bottom-left-radius: 15px;
	border-bottom-right-radius: 15px;
}

article:hover{
	/*opacity: 0.7;*/
	-webkit-transition: all .2s ease-in-out;
	-webkit-transform: translateY(10px) scale(1.1);
		/*-webkit-filter: blur(2px);*/
}

/*article:active{
	transform:translate(200px, 100px);
	-webkit-transform: translate(50%, 50%) scale(1.5);
	
	-webkit-transition: all 0.2s;
}*/

.progress-bar{
	width: 100%;
	height: 50px;
	/*border: 5px solid rgba(127,127,127,0.3);*/
	
	margin-top: 20px;
	margin-bottom: 20px;
	border-radius: 50px;

}

.progress-bar section{
	padding: 8px 20px 8px 20px;
	height: 100%; 
	
	background-color: gray;
	box-shadow: inset 1px 1px 10px black;
	border: 5px solid rgba(127,127,127,0.3);
	border-radius: 50px;

}

.progress-part-list{
	width: 100%;
	table-layout: fixed;
	display: table;
	}

.progress-part-list > div{
	display: table-cell;
    border: 5px solid rgba(127,127,127,0.2);
    /*box-shadow: 1px 1px 2px 2px black;*/
    padding: 10px 6px;
    width: 2%;
    margin-bottom: 0;
}
/*
.progress-part-mid{
	height: 100%;
	width: 2%;
	
	background-color: #52ff00;
	opacity: 0.9;
	display: table-cell;
	float:left;
}

.progress-part-left{
	height: 100%;
	width: 250px;

	background-color: red;
	opacity: 0.9;
	
	display: table-cell;
	border-top-left-radius: 50px;
	border-bottom-left-radius: 50px;
	float:left
}

.progress-part-right{
	height: 100%;
	width: 2%;
	
	background-color: yellow;
	opacity: 0.9;
	
	display: table-cell;
	border-top-right-radius: 50px;
	border-bottom-right-radius: 50px;
	float:right;
}
*/

.section-info{
	background-color: white;
	
	height: 180px;
}

.section-info h2{
	border-bottom: 1px solid rgba(127,127,127,0.3);
	text-align: center;
}

.section-footer{
	/*background-color: #52ff00;*/ /*grön*/
	border: 1px solid rgba(127,127,127,0.3);
	color:white;
	text-shadow: 1px 1px 8px black;
	text-align: center;
	margin-top: 20px;
	border-radius: 15px;
	
}
</style>


<div style="width:100%">
    <div class="paddRow aboutRow">
        <div class="wrap">
        
            <div class="head">"Projektets Namn"</div>
            
            <section class="progress-bar">
				<section class="progress-part-list">
					<div style="background-color:yellow; border-top-left-radius: 50px; border-bottom-left-radius: 50px;">
			
					</div>
		
					<div style="background-color:red">
			
					</div>

					<div style="background-color:#52ff00; border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
			
					</div>
		
				</section>
	
			</section>
            
            
            
            
            <a class="btn" href="javascript: void(0)" ng-click="showAddPart()">+Add</a>
            <div class="paddRow newPartRow">
				<div class="wrap">
					<div class="head">New Part</div>
					<img class="close" src="images/close.png" ng-click="closeAddPart()" />
            
            
            
       
            
            <form action="cproject.php" method="post">
				<span style="font-size:1.5em">Name:</span><br><input type="text" name="name"><br>
				
				<span style="font-size:1.5em">Description: </span><br><textarea rows="4" cols="50"></textarea><br>
			
				<input class="btn" type="submit" value="Create"/>
			</form>
            </div>
    </div>        
            
            
            
        </div>
    </div>

    <div style="background-color:#f5f5f5">
    <!-- class="wrap about" är den div som alla dokument ligger i -->
        <div class="wrap about" ng-app="example359" style="height:500px; padding-top: 20px">
            
            
            
            
            

	<article>
	<section>
		<section class="section-info">
			<h2>Klar del!</h2>
			<p>Info om del</p>
		</section>
	
	
		<!-- Hämta in vilken färg den ska ha för background-color. Beroende på i vilket stadie den är i.-->
		<section class="section-footer" style="background-color: #52ff00;" >
			Klar
		</section>
	</section>
</article>

<article>
	<section>
		<section class="section-info">
			<h2>Påbörjad del!</h2>
			<p>Info om del</p>
		</section>
	
	
		
		<section class="section-footer" style="background-color: yellow;">
			Påbörjad
		</section>
	</section>
	
</article>

<article>
	<section>
		<section class="section-info">
			<h2>Ej påbörjad del!</h2>
			<p>Info om del</p>
		</section>
	
	
		<section class="section-footer" style="background-color: red;">
			Ej påbörjad
		</section>
	</section>
	
</article>

            
            

        </div>
    </div>
    

    <!--<ng-include src="'pages/footer.html'"></ng-include>-->
</div>