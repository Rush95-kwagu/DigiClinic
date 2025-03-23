// Morris Days
var day_data = [
  { period: "2023-10-01", licensed: 3213, "Bootstrap Gallery": 887 },
  { period: "2023-09-30", licensed: 3321, "Bootstrap Gallery": 776 },
  { period: "2023-09-29", licensed: 3671, "Bootstrap Gallery": 884 },
  { period: "2023-09-20", licensed: 3176, "Bootstrap Gallery": 448 },
  { period: "2023-09-19", licensed: 3376, "Bootstrap Gallery": 565 },
  { period: "2023-09-18", licensed: 3976, "Bootstrap Gallery": 627 },
  { period: "2023-09-17", licensed: 2239, "Bootstrap Gallery": 660 },
  { period: "2023-09-16", licensed: 3871, "Bootstrap Gallery": 676 },
  { period: "2023-09-15", licensed: 3659, "Bootstrap Gallery": 656 },
  { period: "2023-09-10", licensed: 3380, "Bootstrap Gallery": 663 },
];
Morris.Line({
  element: "dayData",
  data: day_data,
  xkey: "period",
  ykeys: ["licensed", "Bootstrap Gallery"],
  labels: ["Licensed", "Bootstrap Gallery"],
  resize: true,
  hideHover: "auto",
  gridLineColor: "#dfd6ff",
  pointFillColors: [
    "#207a5a",
    "#248a65",
    "#116aef",
    "#3ea37e",
    "#53ad8d",
    "#69b89b",
    "#7ec2a9",
    "#94ccb8",
    "#a9d6c6",
  ],
  pointStrokeColors: ["#ffffff"],
  lineColors: [
    "#207a5a",
    "#248a65",
    "#116aef",
    "#3ea37e",
    "#53ad8d",
    "#69b89b",
    "#7ec2a9",
    "#94ccb8",
    "#a9d6c6",
  ],
});
