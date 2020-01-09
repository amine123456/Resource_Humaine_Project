<template>
    <div>
                <div class="card card-primary col-md-12">
              <div class="card-header">
                <h3 class="card-title">Area Chart</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="chartEmployer"  style="height: 243px; width: 487px;" width="487" height="243"></canvas>            
                </div>
              </div>
              <!-- /.card-body -->
            </div>

            
          

    </div>
</template>

<script>
 import moment from 'moment'
 import 'moment/locale/fr'
import VueCharts from 'vue-chartjs'
export default {






  methods:{
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
                                  backgroundColor: '#fffff',
                                  data : this.sets
                          }
                         
                        ],
                        
                      })
                       

                             
                      
    
                      })
                }
                },
                 mounted () {
                        this.loadEmployers();
                  
                    }
}

</script>
