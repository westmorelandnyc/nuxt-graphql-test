<template>
  <div>
    <h1>Reports for {{ data.job?.name }}</h1>
    <ul v-for="report of data.job?.daily_reports" :key="report.id">
      {{
        report.name
      }}
    </ul>
  </div>
</template>

<script setup>
const query = gql`
  query getReportsForJob {
    job(id: 2) {
      id
      name
      daily_reports {
        id
        name
      }
    }
  }
`

const { data } = await useAsyncQuery(query)
if (data.value?.job) {
  console.log({ job: data.value.job })
}
</script>
