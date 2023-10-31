class Analytics{
  userAnalysis() {
    let dataHistory = [];
    let start = 0,end = 0,totalTime = 0;
    window.addEventListener('DOMContentLoaded', function() {
      start = new Date().getTime();
    });

    document.addEventListener('click', (event) => {
      dataHistory.push({
        clickedElement: event.target.dataset ? event.target.dataset : event.target.innerHTML,
        timestamp: new Date(),
        action: event.target.innerHTML
      });
    })

    window.addEventListener('beforeunload', function() {
      end = new Date().getTime();
      totalTime = (end - start) / 1000;
      dataHistory.push({'start' : start,'end' : end,'totalTime' : totalTime, 'url' : document.URL});
    });

    window.onload = window.onunload = function analytics(event) {
      if (!navigator.sendBeacon) return;

      // Url we are sending the data to
      let url = base_path + "analysis";

      //Create the data to send
      const dataHistoryBlob = new Blob([JSON.stringify(dataHistory)], { type: 'application/json' });

      navigator.sendBeacon(url, dataHistoryBlob);
    };
  }
}
const analysis = new Analytics();
analysis.userAnalysis();