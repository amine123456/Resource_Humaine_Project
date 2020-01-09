<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>
            <div class="col-md-12" v-if="$gate.isAdmin()">  
            </div>
             
                    
            </div>
          
        <div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <button class="nav-link active" v-on:click="chart" >Employer</button>
      </li>
      <li class="nav-item">
        <button class="nav-link"  v-on:click="chart1" >Conge</button>
      </li>
      <li class="nav-item">
        <button class="nav-link " v-on:click="chart2" >CongeAccepter</button>
      </li>
      <li class="nav-item">
        <button class="nav-link " v-on:click="chart3" >Recrutement</button>
      </li>
      <li class="nav-item">
        <button class="nav-link " v-on:click="chart4" >Recrutement Accepter</button>
      </li>
      <li class="nav-item">
        <button class="nav-link " v-on:click="chart5" >Absences Non Justifier</button>
      </li>
       <li class="nav-item">
        <button class="nav-link " v-on:click="chart6" >Absences Justifier</button>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Statistics</h5>
    <canvas id="chartConge" ref="canvas" style="height: 243px; width: 487px;" width="487" height="243"></canvas>
   
  </div>
</div>

          
    </div>
</template>

<script>
 import moment from 'moment'
 import 'moment/locale/fr'
import VueCharts from 'vue-chartjs'
   

export default {
  extends: VueCharts.Bar,

  name : 'Dashboard',
  components : {
    
  },

  data(){
    return{
          employer : {} , 
          sets : {} ,
          setcConge : {} ,
          conge : {} ,
          recrutement : {},
          congeaccepter : {} ,
    }
  },

  methods : 
  {
    chart1(){
    this.statisticConge()  ; 

    },
    chart(){  
      this.loadEmployers()
    },
    chart2(){  
      this.congeAccepter()
    },
    chart3(){  
      this.Recrutement()
    },
    chart4(){  
      this.RecrutementAccepter()
    },
    chart5(){  
      this.AbsenceNonJustifier()
    },
    chart6(){  
      this.AbsenceJustifier()
    },

       statisticConge(){     
         axios.get('api/ChartsConge').
               then(({data})=>{ 
                      this.conge = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].starting_day)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mos = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mos.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mos.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.setsConge = set 
                             this.setsConge.push(0)
                             

                             
                             this.renderChart(
                                {
                        labels: mos,
                        datasets: [
                          {
                            label: 'Conge',
                            backgroundColor: '#9932CC',
                            data : this.setsConge
                          }
                         
                        ],
                        
                      })
                       

                             
                      
    
                      })
                },

      async  loadEmployers(){
                  await axios.get('api/Charts').
                    then(({data})=>{ 
                      this.employer = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].created_at)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mo = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mo.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mo.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.sets = set 
                             this.sets.push(0)

                             

                                this.renderChart(
                                {
                        labels: mo,
                        datasets: [
                          {
                            label: 'Employer',
                            backgroundColor: '#5F9EA0',
                            data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                      
    
                      })
                },

                 async  congeAccepter(){
                  await axios.get('api/CongeAccepter').
                    then(({data})=>{ 
                      this.congeaccepter = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].created_at)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mo = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mo.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mo.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.sets = set 
                             this.sets.push(0)

                             

                                this.renderChart(
                                {
                        labels: mo,
                        datasets: [
                          {
                            label: 'CongeAccepter',
                            backgroundColor: '#ff55966f',
                            data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                      
    
                      })
                },

                async  Recrutement(){
                  await axios.get('api/RecrutChart').
                    then(({data})=>{ 
                      this.recrutement = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].created_at)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mo = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mo.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mo.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.sets = set 
                             this.sets.push(0)

                             

                                this.renderChart(
                                {
                        labels: mo,
                        datasets: [
                          {
                            label: 'Recrutement',
                            backgroundColor: '#DAA520',
                            data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                      
    
                      })
                },
                async  RecrutementAccepter(){
                  await axios.get('api/RecruitAccepter').
                    then(({data})=>{ 
                      this.recrutement = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].created_at)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mo = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mo.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mo.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.sets = set 
                             this.sets.push(0)

                             

                                this.renderChart(
                                {
                        labels: mo,
                        datasets: [
                          {
                            label: 'Recrutement Accepter',
                            backgroundColor: '#DAA520',
                            data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                      
    
                      })
                },
                 async  AbsenceNonJustifier(){
                  await axios.get('api/stat').
                    then(({data})=>{ 
                      this.recrutement = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].created_at)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mo = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mo.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mo.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.sets = set 
                             this.sets.push(0)

                             

                                this.renderChart(
                                {
                        labels: mo,
                        datasets: [
                          {
                            label: 'Absences Non Justifier',
                            backgroundColor: '#9C4DC9',
                            data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                    
                      })
                },
                async  AbsenceJustifier(){
                  await axios.get('api/AbsenceJustifier').
                    then(({data})=>{ 
                      this.recrutement = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].created_at)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mo = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mo.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mo.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.sets = set 
                             this.sets.push(0)

                             

                                this.renderChart(
                                {
                        labels: mo,
                        datasets: [
                          {
                            label: 'Absences Justifier',
                            backgroundColor: '#8A2CA2',
                            data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                    
                      })
                },
                async  congeAccepter(){
                  await axios.get('api/CongeAccepter').
                    then(({data})=>{ 
                      this.congeaccepter = data                    
                                var mydate = []
                              for( var x = 0; x < data.length; x++){
                                  mydate.push( data[x].created_at)
                                }
                              
                              var month = []
                              for( var w = 0; w < mydate.length; w++){
                                let d = new Date(mydate[w])
                                
                                  month.push( d.getMonth() +1)
                                }
                              
                              var count = 1
                              var s = 0
                              var set  = []
                              var mo = []
                              for( var i = 0 ; i< month.length ; i++){
                                var j  = i+1
                                if(j < month.length){
                                  if( month[i] != month[j] ){
                                    set.push(count)
                                    mo.push(moment(month[i],'M').format('MMMM'))
                                    count = 1
                                  }else{
                                    count ++
                                  }

                                }else{
                                  mo.push(moment(month[i],'M').format('MMMM'))
                                  set.push(count)
                                }
                              }
                             
                             this.sets = set 
                             this.sets.push(0)

                             

                                this.renderChart(
                                {
                        labels: mo,
                        datasets: [
                          {
                            label: 'CongeAccepter',
                            backgroundColor: '#ff55966f',
                            data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                      
    
                      })
                },
  },


  mounted () {
    this.loadEmployers();
  },
  
}
</script>
