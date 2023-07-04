<template>
  <div>
    <h1>All Jobs</h1>
    <ul v-for="job of data?.jobs" :key="job.id">
      <NuxtLink :to="`/jobs/${job.id}`">{{ job.name }}</NuxtLink>
    </ul>
  </div>
</template>

<script setup>
const query = gql`
  query getJobs {
    jobs {
      id
      name
    }
  }
`
const { data } = await useAsyncQuery(query)
</script>
