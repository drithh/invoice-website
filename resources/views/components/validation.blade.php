@props(['errors'])

@if (!$errors->any())
  <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 5L5 8L11 1" stroke="#14A54D" />
  </svg>
@else
  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd"
      d="M8.54608 0.131012L5.04608 3.63101L1.59204 0.177002L0.659058 1.11099L4.11206 4.565L0.612061 8.065L1.62305 9.07599L5.12305 5.57599L8.59204 9.04501L9.52606 8.112L6.05609 4.642L9.55609 1.142L8.54608 0.131012Z"
      fill="#BB2026" />
  </svg>
@endif
