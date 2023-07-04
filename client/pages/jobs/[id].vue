<template>
  <div>
    <NuxtLink to="/jobs">Back to Jobs</NuxtLink>
    <h1>Reports for {{ data?.job.name }}</h1>
    <ul v-for="report of data?.job.daily_reports" :key="report.id">
      {{
        report.name
      }}
    </ul>
  </div>
</template>

<script setup>
const query = gql`
  query getJob($jobId: ID!) {
    job(id: $jobId) {
      id
      name
      daily_reports {
        id
        name
      }
    }
  }
`
const route = useRoute()
let jobId = route.params.id

const variables = { jobId }
const { data } = await useAsyncQuery(query, variables)
</script>
