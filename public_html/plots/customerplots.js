var theme = {
    color: [
        '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
        '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
    ],

    title: {
        itemGap: 8,
        textStyle: {
            fontWeight: 'normal',
            color: '#408829'
        }
    },

    dataRange: {
        color: ['#1f610a', '#97b58d']
    },

    toolbox: {
        color: ['#408829', '#408829', '#408829', '#408829']
    },

    tooltip: {
        backgroundColor: 'rgba(0,0,0,0.5)',
        axisPointer: {
            type: 'line',
            lineStyle: {
                color: '#408829',
                type: 'dashed'
            },
            crossStyle: {
                color: '#408829'
            },
            shadowStyle: {
                color: 'rgba(200,200,200,0.3)'
            }
        }
    },

    dataZoom: {
        dataBackgroundColor: '#eee',
        fillerColor: 'rgba(64,136,41,0.2)',
        handleColor: '#408829'
    },
    grid: {
        borderWidth: 0
    },

    categoryAxis: {
        axisLine: {
            lineStyle: {
                color: '#408829'
            }
        },
        splitLine: {
            lineStyle: {
                color: ['#eee']
            }
        }
    },

    valueAxis: {
        axisLine: {
            lineStyle: {
                color: '#408829'
            }
        },
        splitArea: {
            show: true,
            areaStyle: {
                color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
            }
        },
        splitLine: {
            lineStyle: {
                color: ['#eee']
            }
        }
    },
    timeline: {
        lineStyle: {
            color: '#408829'
        },
        controlStyle: {
            normal: {color: '#408829'},
            emphasis: {color: '#408829'}
        }
    },

    k: {
        itemStyle: {
            normal: {
                color: '#68a54a',
                color0: '#a9cba2',
                lineStyle: {
                    width: 1,
                    color: '#408829',
                    color0: '#86b379'
                }
            }
        }
    },
    map: {
        itemStyle: {
            normal: {
                areaStyle: {
                    color: '#ddd'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            },
            emphasis: {
                areaStyle: {
                    color: '#99d2dd'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            }
        }
    },
    force: {
        itemStyle: {
            normal: {
                linkStyle: {
                    strokeColor: '#408829'
                }
            }
        }
    },
    chord: {
        padding: 4,
        itemStyle: {
            normal: {
                lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    }
                }
            },
            emphasis: {
                lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    }
                }
            }
        }
    },
    gauge: {
        startAngle: 225,
        endAngle: -45,
        axisLine: {
            show: true,
            lineStyle: {
                color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                width: 8
            }
        },
        axisTick: {
            splitNumber: 10,
            length: 12,
            lineStyle: {
                color: 'auto'
            }
        },
        axisLabel: {
            textStyle: {
                color: 'auto'
            }
        },
        splitLine: {
            length: 18,
            lineStyle: {
                color: 'auto'
            }
        },
        pointer: {
            length: '90%',
            color: 'auto'
        },
        title: {
            textStyle: {
                color: '#333'
            }
        },
        detail: {
            textStyle: {
                color: 'auto'
            }
        }
    },
    textStyle: {
        fontFamily: 'Arial, Verdana, sans-serif'
    }
};

function setMapChart(chart_data) { 
  if ($('#customer_map').length ){ 
			  
    var echartMap = echarts.init(document.getElementById('customer_map'), theme);
    
    echartMap.setOption({
    title: {
      text: 'Customers',
      subtext: 'distinct',
      x: 'center',
      y: 'top'
    },
    tooltip: {
      trigger: 'item',
      formatter: function(params) {
      var value = (params.value + '').split('.');
      if (isNaN(value)) value = "0";
      var preValue = value[0].replace(/(\d{1,3})(?=(?:\d{3})+(?!\d))/g, '$1,');
      value = preValue + ' unique customers';
      return params.seriesName + '<br/>' + params.name + ' : ' + value;
      }
    },
    toolbox: {
      show: true,
      orient: 'vertical',
      x: 'right',
      y: 'center',
      feature: {
      mark: {
        show: true
      },
      dataView: {
        show: true,
        title: "Text View",
        lang: [
        "Text View",
        "Close",
        "Refresh",
        ],
        readOnly: false
      },
      saveAsImage: {
        show: true,
        title: "Save Image"
      }
      }
    },
    dataRange: {
      min: chart_data.min,
      max: chart_data.max,
      text: ['High', 'Low'],
      realtime: false,
      calculable: true,
      color: ['#087E65', '#26B99A', '#CBEAE3']
    },
    series: [{
      name: chart_data.label,
      type: 'map',
      mapType: 'world',
      roam: false,
      mapLocation: {
      y: 60
      },
      itemStyle: {
      emphasis: {
        label: {
        show: true
        }
      }
      },
      data: chart_data.data
    }]
    });
}

  if ($('#first_name').length && $('#first_value').length && chart_data.data.length >= 1){
    $("#first_name").text("1st: " + chart_data.data[0].name);
    $("#first_value").text(chart_data.data[0].value);
  }
  if ($('#second_name').length && $('#second_value').length && chart_data.data.length >= 2){
    $("#second_name").text("2nd: " + chart_data.data[1].name);
    $("#second_value").text(chart_data.data[1].value);
  }
  if ($('#third_name').length && $('#third_value').length && chart_data.data.length >= 3){
    $("#third_name").text("3rd: " + chart_data.data[2].name);
    $("#third_value").text(chart_data.data[2].value);
  }
}

function setCustomersChart(chart_data) { 
  if ($('#customer_overall_plot').length ){
			  
        var echartBar = echarts.init(document.getElementById('customer_overall_plot'), theme);

        echartBar.setOption({
          title: {
            text: 'Customers who made a purchase',
            subtext: 'Per month'
          },
          tooltip: {
            trigger: 'axis'
          },
          legend: {
            data: chart_data.labels
          },
          toolbox: {
            show: true,
            feature: {
              saveAsImage: {
                show: true,
                title: "Save Image"
              },
              magicType: {
                show: true,
                title: {
                line: 'Line',
                bar: 'Bar'
                },
                type: ['line', 'bar']
              }
            }
          },
          calculable: false,
          xAxis: [{
            type: 'category',
            data: chart_data.labels
          }],
          yAxis: [{
            type: 'value'
          }],
          series: [{
            name: 'Transactions',
            type: 'line',
            data: chart_data.data,
            markPoint: {
              data: [{
                type: 'max',
                name: 'Max'
              }, {
                type: 'min',
                name: 'Min'
              }]
            },
            markLine: {
              data: [{
                type: 'average',
                name: 'Mean'
              }]
            }
          }]
        });

  }

}

function setDayChart(chart_data) { 
  if ($('#customer_day_plot').length ){
			  
        var echartBar = echarts.init(document.getElementById('customer_day_plot'), theme);

        echartBar.setOption({
          title: {
            text: 'Transactions',
            subtext: 'Day of week'
          },
          tooltip: {
            trigger: 'axis'
          },
          legend: {
            data: chart_data.labels
          },
          toolbox: {
            show: true,
            feature: {
              saveAsImage: {
                show: true,
                title: "Save Image"
              },
              magicType: {
                show: true,
                title: {
                line: 'Line',
                bar: 'Bar'
                },
                type: ['line', 'bar']
              }
            }
          },
          calculable: false,
          xAxis: [{
            type: 'category',
            data: chart_data.labels
          }],
          yAxis: [{
            type: 'value'
          }],
          series: [{
            name: 'Transactions',
            type: 'bar',
            data: chart_data.data,
            markPoint: {
              data: [{
                type: 'max',
                name: 'Max'
              }, {
                type: 'min',
                name: 'Min'
              }]
            },
            markLine: {
              data: [{
                type: 'average',
                name: 'Mean'
              }]
            }
          }]
        });

  }

}

function setMonthChart(chart_data) { 
  if ($('#customer_month_plot').length ){
			  
        var echartBar = echarts.init(document.getElementById('customer_month_plot'), theme);

        echartBar.setOption({
          title: {
            text: 'Transactions',
            subtext: 'Month of year'
          },
          tooltip: {
            trigger: 'axis'
          },
          legend: {
            data: chart_data.labels
          },
          toolbox: {
            show: true,
            feature: {
              saveAsImage: {
                show: true,
                title: "Save Image"
              },
              magicType: {
                show: true,
                title: {
                line: 'Line',
                bar: 'Bar'
                },
                type: ['line', 'bar']
              }
            }
          },
          calculable: false,
          xAxis: [{
            type: 'category',
            data: chart_data.labels
          }],
          yAxis: [{
            type: 'value'
          }],
          series: [{
            name: 'Transactions',
            type: 'bar',
            data: chart_data.data,
            markPoint: {
              data: [{
                type: 'max',
                name: 'Max'
              }, {
                type: 'min',
                name: 'Min'
              }]
            },
            markLine: {
              data: [{
                type: 'average',
                name: 'Mean'
              }]
            }
          }]
        });

  }

}
function setCustomerKpis(data) { 
  if ($('#avgTransactions').length ){
		$("#avgTransactions").text(data.avgTransactions);
  }
  if ($('#avgSpentMoney').length ){
		$("#avgSpentMoney").text(data.avgSpentMoney + " €");
  }
  if ($('#avgLifespan').length ){
		$("#avgLifespan").text(data.avgLifespan + " days");
  }
  if ($('#totalCustomers').length ){
		$("#totalCustomers").text(data.totalCustomers);
  }
}

$(document).ready(function(){ //getting JSON-data from php-file, using jQuery
  NProgress.start();
  $.getJSON("http://liacs.leidenuniv.nl/~s2385937/api/countries.php", function(data){ 
        setMapChart(data);
        NProgress.done();
  });
  $.getJSON("http://liacs.leidenuniv.nl/~s2385937/api/customers.php", function(data){ 
        setCustomersChart(data);
  });
  $.getJSON("http://liacs.leidenuniv.nl/~s2385937/api/consumption_weekly.php", function(data){ 
        setDayChart(data);
    });
  $.getJSON("http://liacs.leidenuniv.nl/~s2385937/api/consumption_monthly.php", function(data){ 
      setMonthChart(data);
  });
  $.getJSON("http://liacs.leidenuniv.nl/~s2385937/api/customers_kpis.php", function(data){ 
      setCustomerKpis(data);
  });
});